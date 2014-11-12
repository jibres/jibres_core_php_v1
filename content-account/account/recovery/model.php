<?php
class model extends main_model
{
	function post_recovery(){
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
}
?>