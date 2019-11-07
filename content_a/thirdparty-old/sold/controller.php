<?php
namespace content_a\thirdparty\sold;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartySold');

		\content_a\thirdparty\load::check_access();
	}
}
?>