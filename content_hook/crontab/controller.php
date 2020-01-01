<?php
namespace content_hook\crontab;


class controller
{
	use \content_hook\cronjob\times;
	use \content_hook\cronjob\fn_list;


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

		// \dash\log::set('CronjobMasterOK');

		self::cronjob_run();

		// this is ok
		\dash\notif::ok("Ok ;)");
		\dash\code::jsonBoom(\dash\notif::get());
	}



	private static function cronjob_run()
	{
		// this cronjob must be run every time
		self::master_cronjob();

		if(self::every_10_min())
		{
			self::expire_notif();
			\dash\db\comments::close_solved_ticket();
			\dash\utility\ip::check_is_block();
			\dash\db\comments::spam_by_block_ip();
		}

		if(self::every_30_min())
		{
			self::check_error_file();
			self::removetempfile();
		}

		\dash\app\log\send::notification();

		if(self::at('01:00'))
		{
			\dash\utility\dayevent::save();
		}
	}

}
?>