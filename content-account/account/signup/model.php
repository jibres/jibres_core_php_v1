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
			var_dump("new: can add to db");

			$qry		= $this->sql()->tableUsers()
							->setUser_mobile($mymobile)
							->setUser_pass($mymobile)
							->setUser_extra($mystore);
			$sql		= $qry->insert();
			$myuserid	= $sql->LAST_INSERT_ID();
			$mycode		= $this->randomCode();
			
			
			$qry		= $this->sql()->tableVerifications()
							->setVerification_type('mobileregister')
							->setVerification_value($mymobile)
							->setVerification_code($mycode)
							->setUser_id($myuserid)
							->setVerification_verified('no');
			$sql		= $qry->insert();



			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function()
			{
				debug_lib::true("Register successfully");
			} );

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug_lib::fatal("Register failed!");
			} );
		}

		else
		{
			// mobile exist more than 2 times!
			debug_lib::fatal("Please forward this message to Administrator");
		}


		// $myform = $this->validate("@signup");
		// $query  = $this->sql()->insert()->table("users")->field(array(
		// 	"user_email"       => $myform->username,
		// 	"user_pass"        => $myform->password
		// 	));
		// //var_dump($query->on);
		// $query->result();
		// $this->commit(function(){
		// 	$this->debug->true("Register Successfully");
		// });
		// $this->rollback(function(){
		// 	$this->debug->fatal("an error occur during registration");
		// });


		//var_dump("hi javad, plz commit all change to git server.");
		//var_dump($this->debug->compile());
		//$this->redirect = false;
		

		// we need to create a module for sale the account to users for ourselves
		// 
		// 
		// 
		// 
		// $x = new dbconnection_lib
		// $x->query("my QUERY")
	}
}
?>