<?php
class model extends main_model
{
	function post_signup(){
		// for debug you can uncomment below line to disallow redirect
		$this->redirect 	= false;
		$mymobile	= str_replace(' ', '', post::mobile());
		$mypass		= post::password();
		$mystore	= post::store();
		$tmp_result	=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();
		if($tmp_result->num() == 1)
		{
			// mobile exist
			// login: check password then user can login
			// register: show error

			debug_lib::fatal("Mobile number exist!");
		}

		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			// login: show mobile does not exist
			// register: ok, can register

			$qry		= $this->sql()->tableUsers()
							->setUser_type('store_admin')
							->setUser_mobile($mymobile)
							->setUser_pass($mypass)
							->setUser_extra($mystore);
			$sql		= $qry->insert();
			// var_dump(debug_lib::compile());
			// var_dump($sql->string());
			$myuserid	= $sql->LAST_INSERT_ID();
			$myuserid	= 15;
			$mycode		= $this->randomCode();
			
			
			$qry		= $this->sql()->tableVerifications()
							->setVerification_type('mobileregister')
							->setVerification_value($mymobile)
							->setVerification_code($mycode)
							->setUser_id($myuserid)
							->setVerification_verified('no');
			$sql		= $qry->insert();
			// var_dump($sql->string());
			var_dump(debug_lib::compile());
			//send sms
			// var_dump($mycode);



			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function()
			{
				debug_lib::true("Register successfully");
				// var_dump("Register");

				header("location: "."/verification?mobile=".substr($mymobile, 1) );
			} );

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug_lib::fatal("Register failed!");
				// var_dump("failed");
			} );
		}

		else
		{
			// mobile exist more than 2 times!
			debug_lib::fatal("Please forward this message to Administrator");
		}

		// we need to create a module for sale the account to users for ourselves
		// $x = new dbconnection_lib
		// $x->query("my QUERY")
	}
}
?>