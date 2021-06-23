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
		\dash\data::weekdayList(['monday','tuesday','wednesday','thursday','friday', 'saturday','sunday',]);

		if(\dash\language::current() === 'fa')
		{
			\dash\data::weekdayList(['saturday','sunday', 'monday','tuesday','wednesday','thursday','friday',]);
		}

		$load = \lib\store::detail('order_schedule');
		$load = json_decode($load, true);
		\dash\data::dataRow($load);

		return $load;
	}




	public static function save()
	{

		$status = \dash\validate::enum(\dash\request::post('status'), false, ['enum' => ['active', 'deactive', 'schedule']]);
		if(!$status)
		{
			$status = 'active';
		}

		if(\dash\request::post('add') === 'schedule')
		{
			$status = 'schedule';
		}

		$args = [];


		$dataRow = self::load();

		if(isset($dataRow['schedule']) && is_array($dataRow['schedule']))
		{
			$schedule = $dataRow['schedule'];
		}
		else
		{
			$schedule = [];
		}

		if(\dash\request::post('remove') === 'time')
		{
			$status = 'schedule';
			$index = \dash\request::post('index');
			if(isset($schedule[$index]))
			{
				unset($schedule[$index]);
			}
			else
			{
				\dash\notif::error(T_("Can not find this time in your list"));
				return false;
			}
		}

		$args['status'] = $status;

		if(\dash\request::post('add') === 'schedule')
		{
			$weekday = \dash\validate::weekday(\dash\request::post('weekday'));
			if(!$weekday)
			{
				\dash\notif::error(T_("Please set the weekday"));
				return false;
			}

			$start = \dash\validate::time(\dash\request::post('start'));
			if(!$start)
			{
				\dash\notif::error(T_("Please set the start time"));
				return false;
			}

			$end = \dash\validate::time(\dash\request::post('end'));
			if(!$end)
			{
				\dash\notif::error(T_("Please set the end time"));
				return false;
			}

			if(floatval(str_replace(':', '', $start)) > floatval(str_replace(':', '', $end)))
			{
				\dash\notif::error(T_("Start time must be before end time!"), ['element' => ['start', 'end']]);
				return false;
			}

			foreach ($schedule as $key => $value)
			{
				if(isset($value['weekday']) && $value['weekday'] === $weekday)
				{
					if(self::int_time($start) < self::int_time($value['end']) && self::int_time($end) > self::int_time($value['start']))
					{
						\dash\notif::error(T_("Conflict time in :weekday", ['weekday' => T_($weekday)]));
						return false;
					}
				}
			}

			$schedule[] = ['weekday' => $weekday, 'start' => $start, 'end' => $end];
		}

		$args['schedule'] = $schedule;

		return \lib\app\store\edit::selfedit(['order_schedule' => json_encode($args)]);

	}

	private static function int_time($_time)
	{
		return floatval(str_replace(':', '', $_time));
	}
}
?>