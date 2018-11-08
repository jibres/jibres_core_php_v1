<?php
namespace content_a\product\manage;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productManagementView');
		\content_a\product\load::product();
	}
}
?>
