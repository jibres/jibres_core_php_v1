<?php
class view extends main_view
{
 	public function config()
	{
		$this->global->page_title = 'Login';
		//$myForm = $this->form("@login");
	}
}
class forms extends forms_lib{
    function login(){
        $this->input    = $this->make('#hidden')->value('login');
        $this->username = $this->make("#username");
        $this->password = $this->make("#password");
        $this->robot    = $this->make("#robot");
        $this->submit   = $this->make("#submit")->value("Sign in");
    }
}
?>