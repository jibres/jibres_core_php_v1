<?php
class view extends main_view
{
    function config(){
        $this->global->page_title = 'Sign Up';
        //$myForm = $this->form("@signup");
    }
}
class forms extends forms_lib{
    function signup(){
        $this->input = $this->make('#hidden')->value('signup');
        /*
        $this->name = $this->make("#faname")->name("name")->label("Your name :)");
        $this->name
            ->validate()
            ->form("set", "Please insert your name")
            ->form("reg", "Your name must be in min 3 character and [a-z]");
        */
        $this->username = $this->make("#username");
        $this->password = $this->make("#password");
        $this->robot    = $this->make("#robot");
        $this->submit   = $this->make("#submit")->value("Try it for Free!");
    }
}
?>