<?php
namespace content_b1\business\plan;


class model
{

	public static function post()
	{
		$args             = [];

		if(\dash\request::input_body('sync_required'))
		{
			\lib\app\plan\businessPlanDetail::sync_required();
		}

		\dash\notif::ok(T_("Setting saved"));

		\content_b1\tools::say([]);
	}

}
?>