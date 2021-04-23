<?php
namespace content_a\pagebuilder\home;


class controller
{
	public static function routing()
	{
		$homepage_builder = \dash\temp::get('homepage_builder');

		$child    = \dash\url::child();

		if($child)
		{
			\lib\pagebuilder\tools\admin_design::route();
		}
	}
}
?>