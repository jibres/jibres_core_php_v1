<?php
namespace content_a\thirdparty\log;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyLogView');


		\content_a\thirdparty\load::check_access();
	}
}
?>