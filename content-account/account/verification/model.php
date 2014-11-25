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
			$this->commit(function($parameter)
			{
				debug_lib::true("Verify successfully");
				$this->redirect('/login?mobile='.(substr($parameter,1)));
			}, $mymobile);

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