<?php
namespace content_enter\signup;

class controller
{
	public static function routing()
	{
		\content_enter\controller::check_disallow_business_enter_signup(true);
		\dash\csrf::set(true);
	}



}
?>