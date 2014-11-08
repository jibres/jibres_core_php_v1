<?php
	class customforms_cls{
		public function login(){
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_pass, user_mobile, submit");
			$form->hidden->value("login");
			$form->submit->value("Login");
			return $form;
		}
	}
?>