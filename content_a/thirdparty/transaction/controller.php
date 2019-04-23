<?php
namespace content_a\thirdparty\transaction;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyTransaction');

		\content_a\thirdparty\load::check_access();
	}
}
?>