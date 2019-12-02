<?php
namespace content_su\db;


class model
{
	public static function post()
	{
		\dash\notif::warn('hi :)');
		return;

		$result = null;
		$exist  = true;

		if(\dash\request::post('type') == 'upgrade')
		{
			// do upgrade
			$result = \dash\db::install(true, true);
		}
		elseif(\dash\request::post('type') == 'backup')
		{
			// do backup
			$result = \dash\db::backup(true);
		}
		elseif(\dash\request::post('type') == 'backup_dump')
		{
			// do backup
			$result = \dash\db::backup_dump();
		}

		\dash\log::set('su_upgradeDataBase');


		\dash\code::pretty($result, true);
		\dash\code::boom();


	}
}
?>