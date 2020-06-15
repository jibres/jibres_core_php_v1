<?php
namespace content_b1\product\next;


class controller
{
	public static function routing()
	{
		\content_b1\tools::appkey_required();
		\content_b1\tools::apikey_required();
		\dash\permission::access('ProductEdit');
	}
}
?>