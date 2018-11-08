<?php
namespace content_a\setting\plan;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditPlan');
	}
}
?>