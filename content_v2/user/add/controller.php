<?php
namespace content_v2\user\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('contentCrm');
	}

}
?>