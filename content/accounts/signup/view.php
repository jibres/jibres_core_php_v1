<?php
class view extends main_view
{
    public function config()
    {
        $this->data->module =$this->url_method();
        $this->global->page_title = ucfirst($this->data->module);
        $this->createform(".".$this->data->module);
        $this->data->form_title =$this->data->module;
    }
}
?>