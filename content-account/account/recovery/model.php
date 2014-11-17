<?php
class model extends main_model
{
	function post_recoveryold(){
		$myform = $this->validate("@recovery");

		$datarow = $this->sql()->select()->table("users")
		->where("user_email='" . $myform->username->compile() 
			. "' or user_mobile='" . $myform->username->compile() . "'")->assoc();
		// soon seperate it by mobile or by email

		if($datarow)
		{
			$tmp_user_id     = $datarow['user_id'];
			$tmp_user_email  = $datarow['user_email'];
			$tmp_today       = date("Ymd");
			$tmp_verify_code = md5("$tmp_user_id $tmp_today");


			$query = $this->sql()->insert("verifications")->field(array(
				"verification_type"  =>"forget",
				"verification_email" => $tmp_user_id,
				"verification_code"  => $tmp_verify_code,
				"user_id"            => $tmp_user_id
				));

			$query->result();
			$this->commit(function(){
				$this->debug->true("Step 1 of 2 is complete. Please check your email to continue");
				// send email or send sms to mobile
				
				// *******************************************Send Email
				$to      = "$tmp_user_email";
				$subject = 'Lazood Acount Recovery';
				$headers = "From: no-reply@dev.samac.ir" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				$headers .= 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";

				$message = '<html><body>';

				$message .= '<h1>Lazood</h1><hr />';
				$message .= "<p>Please click the following link to verify your e-mail address and set a password of your choosing.";
				$message .= " Alternatively you can copy-paste the link into your browser's address bar.<br /><br />";
				$message .= '<p style="direction:ltr"><a href="http://dev.samac.ir/accounts/recovery/'. $tmp_verify_code .
							'">http://dev.samac.ir/accounts/recovery/'. $tmp_verify_code .'</a></p>';

				$message .= '<br /><p>Best regards, Samac Team</p>';
				$message .= '</body></html>';

				mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);

			});
			$this->rollback(function(){
				$this->debug->fatal("An error occur during create verification code");
			});

		}
		else
		{
			$this->debug->fatal("Your email or mobile number is not exist!");
		}


		/*		
		$this->commit(function(){
			$this->debug->true("Register Successfully");
		});
		$this->rollback(function(){
			$this->debug->fatal("an error occur during registration");
		});
		*/

	}
	function post_recovery()
	{
		// for debug you can uncomment below line to disallow redirect
		$this->redirect 	= false;
		$mymobile	= str_replace(' ', '', post::mobile());
		$tmp_result	=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		if($tmp_result->num() == 1)
		{
			// mobile exist
			// login: check password then user can login
			// register: show error
			// recovery: let's go
			
			$tmp_result = $tmp_result->assoc();
			$myuserid	= $tmp_result['id'];
			$mycode		= $this->randomCode();
			
			$qry		= $this->sql()->tableVerifications()
							->setVerification_type('mobileforget')
							->setVerification_value($mymobile)
							->setVerification_code($mycode)
							->setUser_id($myuserid)
							->setVerification_verified('no');
			$sql		= $qry->insert();

			//send sms
			var_dump($mycode);

			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function()
			{
				debug_lib::true("Step 1 of 2 is complete. Please check your mobile to continue");
			} );

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug_lib::fatal("Recovery failed!");
			} );
		}

		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			// login: show mobile does not exist
			// register: ok, can register
			debug_lib::fatal("Mobile number is incorrect");
		}

		else
		{
			// mobile exist more than 2 times!
			debug_lib::fatal("Please forward this message to Administrator");
		}
	}

}
?>