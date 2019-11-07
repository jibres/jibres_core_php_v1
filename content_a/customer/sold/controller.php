<?php
namespace content_a\customer\sold;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerSold');

		\content_a\customer\load::check_access();
	}
}
?>