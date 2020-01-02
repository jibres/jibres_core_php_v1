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
				// self::pull();
				\dash\notif::info('system pull successfully');
				break;

			case 'upgrade':
				// self::upgrade();
				\dash\notif::info('system upgrade successfully');
				break;

			case 'unlock':
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