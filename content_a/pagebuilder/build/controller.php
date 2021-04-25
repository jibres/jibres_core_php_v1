<?php
namespace content_a\pagebuilder\build;


class controller
{
	public static function routing()
	{
		$subchild    = \dash\url::subchild();

		if($subchild)
		{
			\lib\pagebuilder\tools\admin_design::route();
		}
	}
}
?>