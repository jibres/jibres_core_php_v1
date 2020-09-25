<?php
namespace content_hook\crontab;


class controller
{
	use \content_hook\crontab\times;


	public static function routing()
	{
		if(\dash\permission::supervisor())
		{
			self::cronjob_run();
			return;
		}

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

		if(!\dash\engine\store::inStore())
		{

			\lib\app\business_domain\run::run();

			// to not check every min all backup setting!
			// the backup setting have special schedule
			if(self::every_hour())
			{
				\dash\engine\backup\database::run();

				\lib\app\statistics\homepage::refresh();

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

			if(self::every_hour())
			{
				\lib\app\nic_domain\autorenew::run();
			}

			if(self::in_hour(['07', '09', '11', '13', '15', '17', '19', '21', '23']))
			{
				\dash\app\ticket::check_unanswer_ticket();
			}

			// get nic pull request every 5 min
			if(self::every_5_min())
			{
				\lib\app\nic_poll\get::cronjob_list();
			}



			self::check_error_file();

		}

		if(\dash\engine\store::inStore())
		{
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

		\dash\app\log\send::notification();

		if(self::every_10_min())
		{
			// sync every statistics between stores and jibres
			\lib\app\sync\statistics::fire();
		}

		// remove all expire session
		if(self::at('01:10'))
		{
			\dash\db\sessions::remove_old_expire();
		}



		if(self::every_hour())
		{

			\dash\db\logs::expire_notif();
			\dash\db\comments::close_solved_ticket();
			\dash\utility\ip::block_new_ip();
			\dash\db\comments::spam_by_block_ip();
		}


		if(self::at('01:00'))
		{
			\dash\utility\dayevent::save();
		}
	}




	private static function check_error_file()
	{
		$sqlHardCritical = YARD. 'jibres_log/database/log-hard-critical.sql';

		if(is_file($sqlHardCritical))
		{
			\dash\log::set('su_sqlHardCritical');
		}


		$sqlError = YARD. 'jibres_log/database/error.sql';

		if(is_file($sqlError))
		{
			\dash\log::set('su_sqlError');
		}

		$phpBug = YARD. 'jibres_log/php/exception.log';

		if(is_file($phpBug))
		{
			\dash\log::set('su_phpBug');
		}
	}

}
?>