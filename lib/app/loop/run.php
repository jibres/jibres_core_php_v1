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
			else
			{
				$status = self::status();

				if($status && is_string($status))
				{
					$last_date = substr($status, 0, 19);

					if(time() - strtotime($last_date) > (120))
					{
						\dash\log::to_supervisor('#cronjob More than 120 seconds have passed since the last loop time! Please check cronjob while true status!');
					}
				}
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

	}


	private static function run()
	{
		$i = 0;

		self::status('Started');

		while (true)
		{
			$i++;

			// run code
			\lib\app\sms\queue::send_real_time();

			\dash\app\telegram\queue::send_real_time();

			// check force stop
			if(($i % 60) == 0 || date("s") === '00')
			{
				if(self::force_stop())
				{
					// save log and exit loop
					self::status('Exited -- count '. \dash\fit::number_en($i));
					\dash\code::boom();
					return;
				}

				self::status('Running -- count '. \dash\fit::number_en($i));

			}

			sleep(1);
		}
	}


	/**
	 * Get current status
	 *
	 * @param      <type>  $_status  The status
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function status($_status = null)
	{
		if($_status)
		{
			$_status = date("Y-m-d H:i:s"). ' '. $_status;

			\lib\app\setting\tools::update('cronjob', 'jibres_loop_while_true_status', $_status);
		}
		else
		{
			$setting = \lib\app\setting\tools::get('cronjob', 'jibres_loop_while_true_status');

			if(isset($setting['value']))
			{
				return $setting['value'];
			}
		}

	}


	/**
	 * Force stop
	 *
	 * @param      bool  $_action  The action
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function force_stop($_action = null)
	{
		if($_action === true)
		{
			\lib\app\setting\tools::update('cronjob', 'jibres_loop_while_true', 'force_stop');
		}
		elseif($_action === false)
		{
			\lib\app\setting\tools::update('cronjob', 'jibres_loop_while_true', 'running');
		}
		else
		{
			$setting = \lib\app\setting\tools::get('cronjob', 'jibres_loop_while_true');

			if(isset($setting['value']))
			{
				if($setting['value'] === 'running')
				{
					return false;
				}
			}
		}

		return true;
	}
}
?>