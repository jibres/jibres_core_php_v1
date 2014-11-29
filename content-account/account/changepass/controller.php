<?php
class controller extends main_controller
{
	public function options()
	{
		// var_dump(get::from());
		if(!get::from() || !get::mobile() || get::from()!='verification')
		{
			page_lib::access("You cant access to this page!");
		}
	}
}
?>