<?php
namespace content_b1\user\remove;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_crm');
	}

}
?>