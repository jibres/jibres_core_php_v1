<?php
namespace content_a\customer\billing;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerBillingView');
		\content_a\customer\load::check_access();
	}
}
?>