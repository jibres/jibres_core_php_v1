<?php
class view extends main_view
{
 	public function config()
	{
		$this->global->page_title = 'Login';
		// $myForm = $this->form("@users");
        //$myForm->atFirst("user_email");
        //$myForm->atEnd("user_email");
        // $myForm->before("user_email", "user_pass");
        // $myForm->white("user_pass");
        // $myForm->remove("user_pass");
        
        // echo "<pre>";
        // print_r($myForm->compile());
        // exit();
        
        
        $this->createform(".login");
        $this->data->module ="login";
        $this->data->form_title ="login";
        
	}
}
?>