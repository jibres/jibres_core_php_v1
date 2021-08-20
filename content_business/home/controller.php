<?php
namespace content_business\home;

class controller
{
	public static function routing()
	{
		\dash\temp::set('InBusinessHomeController', true);

		\content_site\preview\controller::demo_router();
	}
}
?>