<?php
namespace content_hook\crontab;


class controller
{
	use \content_hook\crontab\times;
	use \content_hook\crontab\fn_list;


	public static function routing()
	{
		if(\dash\permission::supervisor())
		{
			self::cronjob_run();
			return;
		}

		// only by run php can set this tld :)
		if(\dash\url::tld() !== 'WorldSalesEngineeringSystem')
		{
			\dash\header::status(416, 'tld!');
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
		if(!\dash\engine\store::inStore())
		{
			// to not check every min all backup setting!
			// the backup setting have special schedule
			if(self::every_hour())
			{
				\dash\engine\backup\database::run();
			}

			if(self::every_30_min())
			{
				\lib\app\statistics\homepage::refresh();
				self::check_error_file();
				self::removetempfile();
			}
		}

		if(\dash\engine\store::inStore())
		{
			// run export if exists
			\lib\app\export\run::crontab();
			// run import if exists
			\lib\app\import\run::crontab();
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

		if(self::every_10_min())
		{
			self::expire_notif();
			\dash\db\comments::close_solved_ticket();
			\dash\utility\ip::check_is_block();
			\dash\db\comments::spam_by_block_ip();
		}


		if(self::at('01:00'))
		{
			\dash\utility\dayevent::save();
		}
	}

}
?>