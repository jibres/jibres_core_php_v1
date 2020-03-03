<?php
namespace content_v2\category\child;


class controller
{
	public static function routing()
	{
		\content_v2\tools::appkey_required();
		\content_v2\tools::apikey_required();

	}
}
?>