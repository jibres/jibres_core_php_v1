<?php
namespace content_a\thirdparty\profile;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyProfile');

		\content_a\thirdparty\load::check_access();
	}
}
?>