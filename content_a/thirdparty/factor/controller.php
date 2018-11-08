<?php
namespace content_a\thirdparty\factor;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyFactorView');

		\content_a\thirdparty\load::check_access();
	}
}
?>