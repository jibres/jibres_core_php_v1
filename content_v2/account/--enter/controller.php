<?php
namespace content_v2\account\enter;


class controller
{
	public static function routing()
	{
		\content_v2\tools::appkey_required();
	}

}
?>