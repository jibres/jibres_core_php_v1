<?php
namespace content_a\pagebuilder\build;


class controller
{
	public static function routing()
	{
		$homepage_builder = \dash\temp::get('homepage_builder');

		$subchild    = \dash\url::subchild();

		if($subchild)
		{
			\lib\pagebuilder\tools\admin_design::route();
		}
	}
}
?>