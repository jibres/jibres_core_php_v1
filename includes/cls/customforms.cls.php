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
			$form->hidden->value(__FUNCTION__);
			$form->before("user_mobile","user_pass");
			$form->user_mobile->label('')->pl('Mobile');
			$form->user_mobile->value( ((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):"") );
			$form->user_pass->label('')->pl('Password');
			$form->submit->value("");
			return $form;
		}

		public function signup()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_mobile, user_pass, submit");
			$form->hidden->value(__FUNCTION__);
			$form->before("user_mobile","user_pass");
			$form->user_mobile->label('')->pl('Mobile');
			$form->user_mobile->value( ((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):"") );
			$form->user_pass->label('')->pl('Password');
			$form->submit->value("");
			return $form;
		}

		public function recovery()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_mobile, submit");
			$form->hidden->value(__FUNCTION__);
			$form->user_mobile->label('')->pl('Mobile');
			$form->user_mobile->value( ((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):"") );
			$form->submit->value("");
			return $form;
		}

		public function changepassword()
		{
			$form = new forms_lib;
			$form = $form->make("@users");
			$form->white("hidden, user_pass, submit");
			$form->hidden->value(__FUNCTION__);
			$form->user_pass->label('')->pl('Password');
			$form->submit->value("");
			return $form;
		}

		public function verification()
		{
			$form = new forms_lib;
			$form = $form->make("@verifications");
			$form->white("hidden, verification_value ,verification_code, submit");
			$form->hidden->value(__FUNCTION__);
			$form->verification_value->label('')->type("tel")->name("mobile")->pl("Mobile")->pattern(".{10,}")->maxlength(17)->required();
			$form->verification_value->value( ((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):"") );
			$form->verification_code->label('')->pl('Code')->maxlength(4)->autofocus();
			$form->submit->value("");
			return $form;
		}
	}
?>