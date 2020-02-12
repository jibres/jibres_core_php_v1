<?php
namespace content_su\update;

class model
{
	public static function post()
	{
		$type = \dash\request::post('type');

		switch ($type)
		{
			case 'lock':
				self::lock();
				break;

			case 'pull':
				self::pull();
				break;

			case 'upgrade':
				self::upgrade();
				break;

			case 'unlock':
				self::unlock();
				break;

			case 'remove_cache':
				self::remove_cache();
				break;

			case 'all':
				$start = time();
				self::lock();
				self::pull();
				self::upgrade();
				self::unlock();
				self::remove_cache();
				\dash\notif::info(T_("Operation complete at :val second", ['val' => \dash\fit::number(time() - $start)]));
				break;

			default:
				\dash\notif::error(T_("Invalid type"));
				return false;
				break;
		}

		\dash\redirect::pwd();
	}


	private static function lock()
	{
		\dash\engine\lock::lock();
		\dash\notif::warn(T_("System locked"));
	}


	private static function pull()
	{
		if(\content_su\update\controller::gitUpdate('all', false))
		{
			\dash\notif::info(T_('System git pull successfully'));
		}
	}


	private static function upgrade()
	{
		\lib\app\upgradedb\upgrade::run();
		\dash\notif::info(T_('System upgrade database successfully'));
	}


	private static function unlock()
	{
		\dash\engine\lock::unlock();
		\dash\notif::ok(T_("System unlock successfully"));
	}


	private static function remove_cache()
	{
		exec("rm -r ". root. '/tmp/twig');
		\dash\notif::ok(T_("Twig temp cache removed"));
	}

}
?>