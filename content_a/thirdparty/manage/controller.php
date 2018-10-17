<?php
namespace content_a\thirdparty\manage;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyManageView');
		\content_a\thirdparty\load::check_access();
	}
}
?>