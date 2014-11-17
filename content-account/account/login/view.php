<?php
class view extends main_view
{
 	public function options()
	{
        $this->data->module =config_lib::$method;
        $this->global->page_title = ucfirst($this->data->module);
        // $this->createform(".".$this->data->module);
        $this->createform(".login");
        $this->data->form_title =$this->data->module;

        // $myForm = $this->form("@users");
        //$myForm->atFirst("user_email");
        //$myForm->atEnd("user_email");
        // $myForm->before("user_email", "user_pass");
        // $myForm->white("user_pass");
        // $myForm->remove("user_pass");
        // echo "<pre>";
        // print_r($myForm->compile());
        // exit();
        // var_dump($this->data->module);
        // $myForm                                         = $this->createform(".".$this->data->module);
	}
}
?>