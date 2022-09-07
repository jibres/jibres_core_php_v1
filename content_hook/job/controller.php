<?php
namespace content_hook\job;


class controller
{

	use \content_hook\job\times;


	public static function routing()
	{
		if(!defined('ISCRONJOB') || !defined('CRONJOB_MODE'))
		{
			\dash\header::status(400, ':)');
			return;
		}

		// not run in local
		if(is_file(root . 'islocal.me.conf'))
		{
			\dash\code::boom('job local!');
			return;
		}


		self::cronjob_run();

		\dash\notif::ok("Cronjob ended. Date: " . date("Y-m-d"), ['end_time' => date("H:i:s")]);

		\dash\code::jsonBoom(\dash\notif::get());
	}


	private static function cronjob_run()
	{
		\dash\temp::set('run:by:system', true);

		$server_detail = \dash\setting\servername::current_detail();

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

		if(!\dash\engine\store::inStore())
		{
			self::check_error_file();

			if(self::daily_on('03'))
			{
				\lib\app\statistics\homepage::refresh();
			}
		}
	}


	private static function run_jibres()
	{

		if(CRONJOB_MODE === 'php_run_loop')
		{
			\lib\app\loop\run::fire();
			\dash\notif::ok("Run loop cronjob ended. Time: " . date("Y-m-d H:i:s"));
		}

		if(CRONJOB_MODE === 'php_run_jibres_cronjob')
		{
			// run cronjob jibres
		}
		else
		{
			// not run jibres
			return;
		}

		\dash\notif::ok("Run jibres cronjob started. Time: " . date("Y-m-d H:i:s"));

		// \lib\app\store\changefuel::run();

		\lib\app\domains\owner::check();

		\lib\app\business_domain\run::run();

		if(self::in_hour(['00', '03', '06', '09', '12', '15', '18', '21']))
		{
			\lib\app\business_domain\run::re_pending_dns_not_active();
		}

		// to not check every min all backup setting!
		// the backup setting have special schedule
		// if(self::every_hour())
		// {
		// 	\dash\engine\backup\database::run();
		// }

		// set expire notif
		if(self::daily_on('09'))
		{
			\lib\app\nic_domain\notif_expire::run();
		}

		// fetch credit of nic
		if(self::every_hour())
		{
			\lib\app\nic_credit\get::fetch();
			\lib\app\nic_credit\get::check_refund();
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

		// get nic pull request every 10 min
		if(self::every_10_min())
		{
			\lib\app\nic_poll\get::cronjob_list();
		}

		if(self::daily_on('03'))
		{
			// sync every statistics between stores and jibres
			\lib\app\sync\statistics::fire();
		}

		if(self::daily_on('01'))
		{
			\dash\app\dayevent::save();
		}

		self::public_cronjob();

		\lib\app\store\reserve::create_business_as_reserved();

		\dash\notif::ok("Run jibres cronjob ended. Time: " . date("Y-m-d H:i:s"));
	}


	public static function run_business()
	{
		if(CRONJOB_MODE === 'php_run_business_cronjob_once')
		{
			$fn = ['\\content_hook\\job\\controller', 'business_once'];

			\content_hook\job\business::run_once($fn, 'business_once');

			\dash\notif::ok("Run business cronjob once ended. Time: " . date("Y-m-d H:i:s"));

		}
		elseif(CRONJOB_MODE === 'php_run_business_cronjob_force')
		{
			$fn = ['\\content_hook\\job\\controller', 'public_cronjob'];

			\content_hook\job\business::run_once($fn, 'public_cronjob');

			\dash\notif::ok("Run business cronjob force ended. Time: " . date("Y-m-d H:i:s"));
		}


		// check and auto expire order

	}


	public static function business_once()
	{
		\lib\app\factor\edit::auto_expire_order();

		\lib\app\sms\send::notSended();

		//		if(self::every_5_min())
		{
			// run export if exists
			\lib\app\export\run::crontab();
			// run import if exists
			\lib\app\import\run::crontab();
		}

		if(self::daily_on('03'))
		{
			// sync every statistics between stores and jibres
			\lib\app\sync\statistics::fire();
		}
		if(self::daily_on('01'))
		{
			\dash\app\dayevent::save();
		}
	}


	public static function public_cronjob()
	{

		// remove all expire session
		// clean csrf token used or expired
		if(self::daily_on('01'))
		{
			\dash\db\login\update::remove_old_expire();
			\dash\csrf::clean();
		}

		if(self::every_10_min())
		{
			\dash\db\tickets\update::close_solved_ticket();
			\dash\utility\ip::block_new_ip();
			\dash\db\tickets\update::spam_by_block_ip();
		}

	}


	private static function check_error_file()
	{
		$sqlHardCritical = YARD . 'jibres_log/database/log-hard-critical.sql';

		if(is_file($sqlHardCritical))
		{
			// \dash\log::set('su_sqlHardCritical');
		}


		$sqlError = YARD . 'jibres_log/database/error.sql';

		if(is_file($sqlError))
		{
			$file_mtime = filemtime($sqlError);

			if(\dash\app\log::check_caller_code('su_sqlError', $file_mtime))
			{
				/*nothing*/
			}
			else
			{
				\dash\log::set('su_sqlError', ['code' => $file_mtime, 'my_domain' => \dash\url::domain()]);
			}
		}


		$sqlError = YARD . 'jibres_log/database/error-goneaway.sql';

		if(is_file($sqlError))
		{
			$file_mtime = filemtime($sqlError);

			if(\dash\app\log::check_caller_code('su_sqlErrorGoneaway', $file_mtime))
			{
				/*nothing*/
			}
			else
			{
				\dash\log::set('su_sqlErrorGoneaway', ['code' => $file_mtime, 'my_domain' => \dash\url::domain()]);
			}
		}


		$PDOerror = YARD . 'jibres_log/database/pdo.sql';

		if(is_file($PDOerror))
		{
			$file_mtime = filemtime($PDOerror);

			if(\dash\app\log::check_caller_code('su_PDOError', $file_mtime))
			{
				/*nothing*/
			}
			else
			{
				\dash\log::set('su_PDOError', ['code' => $file_mtime, 'my_domain' => \dash\url::domain()]);
			}
		}


		$phpBug = YARD . 'jibres_log/php/exception.log';

		if(is_file($phpBug))
		{
			$file_mtime = filemtime($phpBug);

			if(\dash\app\log::check_caller_code('su_phpBug', $file_mtime))
			{
				/*nothing*/
			}
			else
			{
				\dash\log::set('su_phpBug', ['code' => $file_mtime, 'my_domain' => \dash\url::domain()]);
			}
		}
	}

}

?>