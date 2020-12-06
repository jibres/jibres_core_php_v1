<?php
namespace content_a\order\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_orders');

		if(\dash\url::subchild() === 'unprocessed')
		{
			var_dump(11);exit();
		}
	}
}
?>
