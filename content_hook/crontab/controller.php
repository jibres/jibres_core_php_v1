<?php
namespace content_hook\crontab;


class controller
{
	use \content_hook\crontab\times;


	public static function routing()
	{
		$child = \dash\url::child();
		if(!$child)
		{
			\dash\header::status(416, 'child');
		}

		if(mb_strlen($child) !== 32)
		{
			\dash\header::status(416, 'child!');
		}

		$read_file = core. 'engine/cronjob_server.me.token';
		$read_file = \dash\file::read($read_file);
		if($child !== $read_file)
		{
			\dash\header::status(416, 'child!!!');
		}

		// stop visitor save for cronjob
		\dash\temp::set('force_stop_visitor', true);

		self::cronjob_run();

		\dash\notif::ok("Ok ;)");
		\dash\code::jsonBoom(\dash\notif::get());
	}



	private static function cronjob_run()
	{
		\dash\temp::set('run:by:system', true);

		$server_detail = \dash\server::current_detail();

		\dash\log::to_supervisor(\dash\url::pwd(). ' - '. json_encode($server_detail));

		$run_jibres = false;
		$run_business = false;

		if(isset($server_detail['cronjob']))
		{
			if(is_array($server_detail['cronjob']) && in_array('jibres', $server_detail['cronjob']))
			{
				$run_jibres = true;
			}

			if(is_array($server_detail['cronjob']) && in_array('business', $server_detail['cronjob']))
			{
				$run_business = true;
			}

			if($server_detail['cronjob'] === 'jibres')
			{
				$run_jibres = true;
			}

			if($server_detail['cronjob'] === 'business')
			{
				$run_business = true;
			}
		}

		if($run_jibres)
		{
			self::run_jibres();
		}

		if($run_business)
		{
			self::run_business();
		}

		self::check_error_file();

		if(!\dash\engine\store::inStore())
		{
			\lib\app\statistics\homepage::refresh();
		}

		if($run_jibres || $run_business)
		{
			\lib\app\sms\queue::send();

			\dash\app\log\send::notification();

			if(self::at('03:43'))
			{
				// sync every statistics between stores and jibres
				\lib\app\sync\statistics::fire();
			}

			// remove all expire session
			// clean csrf token used or expired
			if(self::at('01:10'))
			{
				\dash\db\login\update::remove_old_expire();
				\dash\csrf::clean();
			}

			if(self::every_10_min())
			{
				\dash\db\logs::expire_notif();
				\dash\db\comments::close_solved_ticket();
				\dash\utility\ip::block_new_ip();
				\dash\db\comments::spam_by_block_ip();
			}

			if(self::at('01:00'))
			{
				\dash\app\dayevent::save();
			}
		}

	}


	private static function run_jibres()
	{
		// only run jibres cronjob
		if(\dash\engine\store::inStore())
		{
			return;
		}

		\lib\app\domains\owner::check();

		\lib\app\business_domain\run::run();

		// to not check every min all backup setting!
		// the backup setting have special schedule
		if(self::every_hour())
		{
			\dash\engine\backup\database::run();
		}

		// set expire notif
		if(self::at('09:00'))
		{
			\lib\app\nic_domain\notif_expire::run();
		}

		// fetch credit of nic
		if(self::at('10:00'))
		{
			\lib\app\nic_credit\get::fetch();
		}

		// from 8 to 20
		if(intval(date("H")) > 8 && intval(date("H")) < 20)
		{
			\lib\app\nic_domain\autorenew::run();
		}

		if(self::in_hour(['07', '09', '11', '13', '15', '17', '19', '21', '23']))
		{
			\dash\app\ticket\get::check_unanswer_ticket();
		}

		// get nic pull request every 5 min
		if(self::every_5_min())
		{
			\lib\app\nic_poll\get::cronjob_list();
		}

	}


	public static function run_business()
	{
		// only run jibres cronjob
		if(!\dash\engine\store::inStore())
		{
			return;
		}

		// check and auto expire order
		\lib\app\factor\edit::auto_expire_order();

		if(self::every_5_min())
		{
			// run export if exists
			\lib\app\export\run::crontab();
			// run import if exists
			\lib\app\import\run::crontab();
		}
	}




	private static function check_error_file()
	{
		$sqlHardCritical = YARD. 'jibres_log/database/log-hard-critical.sql';

		if(is_file($sqlHardCritical))
		{
			// \dash\log::set('su_sqlHardCritical');
		}


		$sqlError = YARD. 'jibres_log/database/error.sql';

		if(is_file($sqlError))
		{
			$file_mtime = filemtime($sqlError);

			if(\dash\app\log::check_caller_code('su_sqlError', $file_mtime))
			{
				/*nothing*/
			}
			else
			{
				\dash\log::set('su_sqlError', ['code' => $file_mtime]);
			}
		}

		$phpBug = YARD. 'jibres_log/php/exception.log';

		if(is_file($phpBug))
		{
			$file_mtime = filemtime($phpBug);

			if(\dash\app\log::check_caller_code('su_phpBug', $file_mtime))
			{
				/*nothing*/
			}
			else
			{
				\dash\log::set('su_phpBug', ['code' => $file_mtime]);
			}
		}
	}

}
?>