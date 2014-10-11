<?php
class view extends main_view
{
    function config(){
        $this->global->page_title         = 'Account Recovery';
        $this->global->site_title_show = false;
        //$myForm = $this->form("@recovery");
    }
}
class forms extends forms_lib{
    function recovery(){
        $this->input    = $this->make('#hidden')->value('recovery');
        $this->username = $this->make("#username")->label("Email")->pl("Enter your email");
        $this->robot    = $this->make("#robot");
        $this->submit   = $this->make("#submit")->value("Recovery");
    }
}
?>