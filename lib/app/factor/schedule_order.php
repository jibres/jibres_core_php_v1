<?php
namespace lib\app\factor;


class schedule_order
{
	public static function check()
	{
		$load = \lib\store::detail('order_schedule');
		$load = json_decode($load, true);

		// if not have schedule it is ok
		if(!a($load, 'status'))
		{
			return true;
		}

		if(a($load, 'status') === 'active')
		{
			return true;
		}

		if(a($load, 'status') === 'deactive')
		{
			\dash\notif::error(T_("Receiving the order is temporarily disabled"));
			return false;
		}

		// never!. this is a bug!
		if(a($load, 'status') !== 'schedule')
		{
			return true;
		}


		$weekday = date('l');

		if(isset($load[$weekday]))
		{
			if(a($load, $weekday, 'status') === false)
			{
				\dash\notif::error(T_("Can not get order today!"));
				return false;
			}

			$start = a($load, $weekday, 'start');
			$end   = a($load, $weekday, 'end');

			if($start && $end)
			{
				$start = floatval(str_replace(':', '', $start));
				$end   = floatval(str_replace(':', '', $end));
			}

			return true;

		}
		else
		{
			// bug!
			return true;
		}

	}


	public static function load()
	{
		\dash\data::weekdayList(['Monday','Tuesday','Wednesday','Thursday','Friday', 'Saturday','Sunday',]);

		if(\dash\language::current() === 'fa')
		{
			\dash\data::weekdayList(['Saturday','Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday',]);
		}



		$load = \lib\store::detail('order_schedule');
		$load = json_decode($load, true);
		\dash\data::dataRow($load);
	}


	public static function save($_args)
	{

		$status = \dash\validate::enum(a($_args, 'status'), false, ['enum' => ['active', 'deactive', 'schedule']]);
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
				'status' => a($_args, $weekday. '_enable') ? true : false,
				'start'  => \dash\validate::time(a($_args, $weekday. '_start'), false),
				'end'    => \dash\validate::time(a($_args, $weekday. '_end'), false),
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


		return \lib\app\store\edit::selfedit(['order_schedule' => json_encode($args)]);

	}
}
?>