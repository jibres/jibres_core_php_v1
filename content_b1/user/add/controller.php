<?php
namespace content_b1\user\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_crm');
	}

}
?>