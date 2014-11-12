<?php
class model extends main_model
{
	function post_signup(){
		$myform = $this->validate("@signup");
		$query  = $this->sql()->insert()->table("users")->field(array(
			"user_email"       => $myform->username,
			"user_pass"        => $myform->password
			));
		//var_dump($query->on);
		$query->result();
		$this->commit(function(){
			$this->debug->true("Register Successfully");
		});
		$this->rollback(function(){
			$this->debug->fatal("an error occur during registration");
		});


		//var_dump("hi javad, plz commit all change to git server.");
		//var_dump($this->debug->compile());
		//$this->redirect = false;
		

		// we need to create a module for sale the account to users for ourselves
	}
}
?>