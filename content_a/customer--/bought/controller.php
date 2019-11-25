<?php
namespace content_a\customer\bought;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerBudgetView');
		\content_a\customer\load::check_access();
	}
}
?>