<?php
namespace content_a\setting\order\schedule;


class model
{
	public static function post()
	{
		$post               = \dash\request::post();

		$status = \dash\validate::enum(\dash\request::post('status'), false, ['enum' => ['active', 'deactive', 'schedule']]);
		if(!$status)
		{
			$status = 'active';
		}
		$args = [];
		$args['status'] = $status;

		foreach (\dash\data::weekdayList() as  $weekday)
		{
			$args[$weekday] =
			[
				'status' => \dash\request::post($weekday. '_enable') ? true : false,
				'start'  => \dash\validate::time(\dash\request::post($weekday. '_start'), false),
				'end'    => \dash\validate::time(\dash\request::post($weekday. '_end'), false),
			];

			if($args[$weekday]['start'] && $args[$weekday]['end'])
			{
				if(floatval(str_replace(':', '', $args[$weekday]['start'])) > floatval(str_replace(':', '', $args[$weekday]['end'])))
				{
					\dash\notif::error(T_("Start time must be before end time!"), ['element' => [$weekday. '_start', $weekday. '_end']]);
					return false;
				}
			}
		}


		\lib\app\store\edit::selfedit(['order_schedule' => json_encode($args)]);

		\dash\redirect::pwd();
	}
}
?>