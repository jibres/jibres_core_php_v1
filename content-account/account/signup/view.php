<?php
class view extends main_view
{
    public function config()
    {
        $this->data->module = config_lib::$method;
        $this->global->page_title = ucfirst($this->data->module);
        $this->createform(".".$this->data->module);
        $this->data->form_title =$this->data->module;
    }
}
?>