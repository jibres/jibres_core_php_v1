<?php
namespace content_v2\profile\get;


class controller
{
	public static function routing()
	{
		\content_v2\tools::apikey_required();
	}
}
?>