<?php
	class customforms_cls
	{
		function __construct()
		{
			
		}
		public function login()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_mobile, user_pass, submit");
			$form->hidden->value("login");
			$form->before("user_mobile","user_pass");
			$form->submit->value("Login");
			return $form;
		}
		public function signup()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_mobile, user_pass, submit");
			$form->hidden->value("signup");
			$form->before("user_mobile","user_pass");
			$form->submit->value("Create an account");
			return $form;
		}
		public function recovery()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_email, submit");
			$form->hidden->value("recovery");
			$form->before("user_mobile","user_pass");
			$form->submit->value("Recover my account");
			return $form;
		}
	}
?>