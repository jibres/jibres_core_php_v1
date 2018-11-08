<?php
namespace content_a\thirdparty\glance;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyDashboardVariableView');

		\content_a\thirdparty\load::check_access();
	}
}
?>