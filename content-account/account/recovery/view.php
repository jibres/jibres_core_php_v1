<?php
class view extends main_view
{
    function config(){
        $this->global->page_title         = 'Account Recovery';
        $this->global->site_title_show = false;

        $this->data->module = config_lib::$method;
        // $this->global->page_title = ucfirst($this->data->module);
        $this->createform(".".$this->data->module);
        $this->data->form_title =$this->data->module;
    }
}
// class forms extends forms_lib{
//     function recovery(){
//         $this->input    = $this->make('#hidden')->value('recovery');
//         $this->username = $this->make("#username")->label("Email")->pl("Enter your email");
//         $this->robot    = $this->make("#robot");
//         $this->submit   = $this->make("#submit")->value("Recovery");
//     }
// }

?>