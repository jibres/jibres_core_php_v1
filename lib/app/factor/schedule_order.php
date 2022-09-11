<?php
namespace lib\app\factor;


class schedule_order
{

	private static $status_mode = null;


	public static function check($_notif = false)
	{
		$load = \lib\store::detail('order_schedule');
		if($load && is_string($load))
		{
			$load = json_decode($load, true);
			if(!is_array($load))
			{
				$load = [];
			}
		}
		else
		{
			$load = [];
		}

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
			if($_notif)
			{
				\dash\notif::error(T_("Receiving the order is temporarily disabled"));
			}
			self::$status_mode = 'deactive';

			return false;
		}

		// never!. this is a bug!
		if(a($load, 'status') !== 'schedule')
		{
			return true;
		}


		if(isset($load['schedule']) && is_array($load['schedule']))
		{
			$schedule = $load['schedule'];
		}
		else
		{
			// error !
			return true;
		}

		$weekday_now = date('l');
		$time_now    = date("H:i:s");

		$weekday_now = strtolower($weekday_now);

		$find_this_time_in_list = false;

		foreach ($schedule as $key => $value)
		{
			if(isset($value['weekday']) && $value['weekday'] === $weekday_now)
			{
				if(self::int_time($time_now) >= self::int_time($value['start']) && self::int_time($time_now) <= self::int_time($value['end']))
				{
					$find_this_time_in_list = true;
				}
			}
		}

		if(!$find_this_time_in_list)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Can not get your order at this time"));
			}
			self::$status_mode = 'schedule';
			return false;
		}

		return true;

	}


	public static function load()
	{
		\dash\data::weekdayList(\dash\datetime::weekday_list());


		$load = \lib\store::detail('order_schedule');
		$load = json_decode($load, true);
		\dash\data::dataRow($load);

		return $load;
	}


	public static function message_html()
	{
		$html = '';

		$load = \lib\store::detail('order_schedule');
		if($load && is_string($load))
		{
			$load = json_decode($load, true);
			if(!is_array($load))
			{
				$load = [];
			}
		}
		else
		{
			$load = [];
		}


		// if not have schedule it is ok
		if(!a($load, 'status'))
		{
			return null;
		}

		if(a($load, 'status') === 'active')
		{
			return null;
		}

		if(a($load, 'status') === 'deactive')
		{
			$html .= '<div class="alert alert-danger p-2 rounded-lg mb-1  fs14 danger2">' . T_("Receiving the order is temporarily disabled") . '</div>';
		}
		elseif(!self::check())
		{
			$weekday_now = date('l');
			$weekday_now = strtolower($weekday_now);

			$schedule = a($load, 'schedule');
			if(!is_array($schedule))
			{
				$schedule = [];
			}

			$active_time_today = [];

			foreach ($schedule as $key => $value)
			{
				if(isset($value['weekday']) && $value['weekday'] === $weekday_now)
				{
					$active_time_today[] =
						\dash\fit::text(substr($value['start'], 0, 5)) . ' - ' . \dash\fit::text(substr($value['end'], 0, 5));
				}
			}

			if(empty($active_time_today))
			{
				$html .= '<div class="alert alert-danger p-2 rounded-lg mb-1  fs14 danger2">' . T_("Can not get order today") . '</div>';
			}
			else
			{
				$html .= '<div class="alert alert-danger p-2 rounded-lg mb-1  fs14 danger2">' . T_("Today order time is :val", ['val' => '<br>' . implode("<br>", $active_time_today)]) . '</div>';

			}

		}

		return $html;


	}


	public static function save()
	{

		$status =
			\dash\validate::enum(\dash\request::post('status'), false, ['enum' => ['active', 'deactive', 'schedule']]);
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
			$index  = \dash\request::post('index');
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