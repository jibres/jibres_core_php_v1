<?php
class view extends main_view
{
    // options function call in default config function in main view of admin pannel
    // if you want to use config, add on options function, also in normal situations you don't need to add any code in this function.
    function options()
    {
		$this->include->telinput = true;
    }
}
?>