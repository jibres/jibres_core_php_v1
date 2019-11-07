<?php
namespace content_a\customer\glance;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerDashboardVariableView');

		\content_a\customer\load::check_access();
	}
}
?>