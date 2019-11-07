<?php
namespace content_a\customer\profile;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerProfile');

		\content_a\customer\load::check_access();
	}
}
?>