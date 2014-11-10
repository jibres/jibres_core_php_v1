<?php
	class customforms_cls{
		public function login(){
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_mobile, user_pass, submit");
			$form->hidden->value("login");
			$form->before("user_mobile","user_pass");
			$form->submit->value("Login");
			return $form;
		}
	}
?>