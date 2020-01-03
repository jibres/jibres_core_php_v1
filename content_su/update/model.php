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
				\dash\engine\lock::lock();
				\dash\notif::warn(T_("System locked"));
				break;

			case 'pull':
				if(\content_su\update\controller::gitUpdate('all', false))
				{
					\dash\notif::info(T_('System git pull successfully'));
				}
				break;

			case 'upgrade':
				\lib\app\upgradedb\upgrade::run();
				\dash\notif::info(T_('System upgrade database successfully'));
				break;

			case 'unlock':
				\dash\engine\lock::unlock();
				\dash\notif::ok(T_("System unlock successfully"));
				break;

			case 'all':
				\dash\engine\lock::lock();
				\dash\notif::warn(T_("System locked"));

				if(\content_su\update\controller::gitUpdate('all', false))
				{
					\dash\notif::info(T_('System git pull successfully'));
				}
				\lib\app\upgradedb\upgrade::run();
				\dash\notif::info(T_('System upgrade database successfully'));

				\dash\engine\lock::unlock();
				\dash\notif::ok(T_("System unlock successfully"));
				break;

			default:
				\dash\notif::error(T_("Invalid type"));
				return false;
				break;
		}

		\dash\redirect::pwd();
	}
}
?>