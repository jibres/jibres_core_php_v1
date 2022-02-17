<?php
namespace lib\app\loop;


class run
{


	public static function fire()
	{
		if(\dash\utility\busy::is_busy('jibres_loop_while_true'))
		{
			if(self::force_stop())
			{
				\dash\utility\busy::set_free('jibres_loop_while_true');
			}
			return;
		}

		// system is off!
		if(self::force_stop())
		{
			return;
		}

		\dash\utility\busy::set_busy('jibres_loop_while_true');

		self::run();

		// never set free this cronjob

	}


	private static function run()
	{
		$i = 0;

		while (true)
		{
			$i++;

			// run code
			\lib\app\sms\queue::send_real_time();

			// check force stop
			if(($i % 60) == 0 || date("s") === '00')
			{
				if(self::force_stop())
				{
					// save log and exit loop
					\dash\code::boom();
					return;
				}
			}

			sleep(1);
		}
	}



	private static function force_stop()
	{
		$setting = \lib\app\setting\tools::get('cronjob', 'jibres_loop_while_true');

		if(isset($setting['value']))
		{
			if($setting['value'] === 'force_stop')
			{
				return true;
			}
		}

		return false;
	}
}
?>