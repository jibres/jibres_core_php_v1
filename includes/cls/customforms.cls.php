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
			$form->user_mobile->label('');
			$form->user_mobile->pl('Mobile');
			$form->user_pass->label('');
			$form->user_pass->pl('Password');
			$form->submit->value("");
			return $form;
		}
		public function signup()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_mobile, user_pass, user_extra, submit");
			$form->hidden->value("signup");
			$form->before("user_mobile","user_pass", "user_extra");
			$form->user_mobile->label('');
			$form->user_mobile->pl('Mobile');
			$form->user_pass->label('');
			$form->user_pass->pl('Password');
			$form->user_extra->label('');
			$form->submit->value("");
			return $form;
		}
		public function recovery()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_mobile, submit");
			$form->hidden->value("recovery");
			$form->user_mobile->label('');
			$form->user_mobile->pl('Mobile');
			$form->submit->value("");
			return $form;
		}
	}
?>