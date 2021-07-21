<?php
namespace content_a\accounting\doc\duplicate;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
		\content_a\accounting\doc\edit\controller::routing();
	}
}
?>
