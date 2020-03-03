<?php
namespace content_v2\user\address\add;


class controller
{
	public static function routing()
	{
		\content_v2\tools::appkey_required();
		\content_v2\tools::apikey_required();
		\dash\permission::access('contentCrm');
	}

}
?>