<?php
namespace content_v2\user\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('contentCrm');
	}

}
?>