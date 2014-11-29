<?php
class model extends main_model
{
	function post_verification()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->redirect	= false;
		$mymobile			= str_replace(' ', '', post::mobile());
		$mycode				= post::code();
		$tmp_result			=  $this->sql()->tableVerifications()
								->whereVerification_value($mymobile)
								->andVerification_code($mycode)
								->andVerification_verified('no')
								->select();

		if($tmp_result->num() == 1)
		{
			// mobile and code exist update the record and verify
			$qry		= $this->sql()->tableVerifications()
							->setVerification_verified('yes')
							->whereVerification_value($mymobile)
							->andVerification_code($mycode);
			$sql		= $qry->update();


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function($_parameter, $_parameter2)
			{
				if($_parameter2=='signup')
				{
					//Send SMS
					$sendnotify = new sendnotify_cls;
					$sendnotify->sms($_parameter);

					$this->redirect('/login?from=verification&mobile='.(substr($_parameter,1)));
					debug_lib::true("Verify successfully");
				}
				elseif($_parameter2=='recovery')
				{
					$this->redirect('/changepass?from=verification&mobile='.(substr($_parameter,1)));
					debug_lib::true("Verify successfully. Please Input your new password");	
				}
			}, $mymobile, get::from());

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug_lib::fatal("Verify failed!");
			} );
		}

		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			debug_lib::fatal("This code or mobile is incorrect");
		}

		else
		{
			// mobile exist more than 2 times!
			debug_lib::fatal("Please forward this message to Administrator");
		}


	}

	function post_code()
	{
		$this->redirect 	= false;
		var_dump("direct code: from url");
	}
}
?>