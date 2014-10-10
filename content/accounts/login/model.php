<?php
class model extends main_model
{
	function post_login(){
		// for show var_dump directly from model use below code to show error on blank page
		//var_dump(11111111111111111111111111111111111);
		//$this->redirect = false;
		//
		// or use the this to show on current page
		//$this->debug->fatal("erroraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");

		$myform = $this->validate("@login");

		$datarow = $this->sql()->select()->table("users")
		->where("(user_email='" . $myform->username->compile() 
			. "' or user_mobile='" . $myform->username->compile()  
			. "') and user_pass = '" . $myform->password->compile() . "'");
		$isLogin = $datarow->num();
		$datarow = $datarow->assoc();
		// baraye inke stringesh ro bekhonim complie kardim

		/*
		Alan ke dasti compile kardim dige sql_lib nemidoone kodom error ha baraye kodoom validate ha hast
		be khatere hamin dasti behesh midim; baraye insert lazem nist
		$datarow
		->on('user_email', $myform->username)
		->on('user_mobile', $myform->username)
		->on('user_password', $myform->password);


		$this->debug->true($datarow);
		if user enter correct user and pass save user global data in sessions
		*/
	
		if(!$isLogin){
			$this->debug->status = 0; // false
			// status = 0 ->fatal -> run rollback
			// status = 1 ->true ->run commit
			// status = 2 ->warning ->run commit
		}
		$this->rollback(function(){
			$_SESSION['u_login']     = false;
			$_SESSION['u_details']   = null;
			$_SESSION['u_id']        = null;
			$_SESSION['u_type']      = null;
			$_SESSION['u_gender']    = null;
			$_SESSION['u_firstname'] = null;
			$_SESSION['u_lastname']  = null;
			$_SESSION['u_nickname']  = null;
			$_SESSION['u_email']     = null;
			$_SESSION['u_mobile']    = null;
			$_SESSION['u_birthdate'] = null;
			$_SESSION['u_status']    = null;
			$_SESSION['u_permisson'] = null;

			$this->debug->fatal("Incorrect, Please check email or password");
		});

		$this->commit(function($data){
			$_SESSION['u_login']     = true;
			$_SESSION['u_details']   = $data;
			$_SESSION['u_id']        = $data['user_id'];
			$_SESSION['u_type']      = $data['user_type'];
			$_SESSION['u_gender']    = $data['user_gender'];
			$_SESSION['u_firstname'] = $data['user_firstname'];
			$_SESSION['u_lastname']  = $data['user_lastname'];
			$_SESSION['u_nickname']  = $data['user_nickname'];
			$_SESSION['u_email']     = $data['user_email'];
			$_SESSION['u_mobile']    = $data['user_mobile'];
			$_SESSION['u_birthdate'] = $data['user_birthdate'];
			$_SESSION['u_status']    = $data['user_status'];
			$_SESSION['u_permisson'] = $data['permission_name'];

			$this->debug->true("Login Successfully");
		}, $datarow);
	}
}
?>