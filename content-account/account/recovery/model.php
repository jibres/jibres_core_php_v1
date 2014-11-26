<?php
class model extends main_model
{
	function post_recovery()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->redirect 	= false;
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

			//Send SMS
			$sendnotify = new sendnotify_cls;
			$sendnotify->sms($mymobile, $mycode, config_lib::$method);

			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function($parameter, $parameter2)
			{
				debug_lib::true("Step 1 of 2 is complete. Please check your mobile to continue");
				$this->redirect('/verification?mobile='.(substr($parameter,1)).'&code='.$parameter2);
				

			}, $mymobile, $mycode);

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