<?php
namespace content_a\customer\transaction;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerTransaction');

		\content_a\customer\load::check_access();
	}
}
?>