<?php
namespace content_b1\user\address\add;


class controller
{
	public static function routing()
	{
		\content_b1\tools::appkey_required();
		\content_b1\tools::apikey_required();
		\dash\permission::access('_group_crm');
	}

}
?>