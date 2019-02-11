<?php
namespace content_a\setting\plan;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditPlan');
		$subchild = \dash\url::subchild();
		switch ($subchild)
		{
			case 'choose':
			case 'start':
			case 'simple':
			case 'standard':
			case 'period':
				\dash\open::get();
				\dash\open::post();
				break;

			default:
				# code...
				break;
		}
	}
}
?>