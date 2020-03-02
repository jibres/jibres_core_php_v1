<?php
namespace content_v2\user\edit\avatar;


class controller
{
	public static function routing()
	{
		\dash\permission::access('contentCrm');
	}

}
?>