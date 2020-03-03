<?php
namespace content_v2\account\token;


class controller
{
	public static function routing()
	{
		\content_v2\tools::appkey_required();
	}
}
?>