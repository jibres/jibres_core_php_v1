<?php
namespace content_a\customer\factor;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerFactorView');

		\content_a\customer\load::check_access();
	}
}
?>