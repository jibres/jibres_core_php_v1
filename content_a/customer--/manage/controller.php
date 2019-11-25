<?php
namespace content_a\customer\manage;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerManageView');
		\content_a\customer\load::check_access();
	}
}
?>