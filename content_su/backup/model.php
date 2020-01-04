<?php
namespace content_su\backup;

class model
{
	public static function post()
	{

		if(\dash\request::post('backup') === 'schedule')
		{
			\dash\engine\backup\database::backup_schedule();
			\dash\redirect::pwd();
		}
		elseif(\dash\request::post('backup') === 'now')
		{
			\dash\log::set('backupDb');
			self::backup_now();
		}
		elseif(\dash\request::post('backup') === 'now_log')
		{
			\dash\log::set('backupDbLogDataBase');
			if(defined('db_log_name'))
			{
				self::backup_now(db_log_name);
			}
			else
			{
				\dash\notif::error(T_("Database of logs dose not exists"));
				return false;
			}
		}
		elseif(\dash\request::post('type') === 'remove' && \dash\request::post('file'))
		{
			$file_name = \dash\request::post('file');
			if(\dash\file::delete(database. 'backup/file/'. $file_name))
			{
				\dash\log::set('backupRemoveDb');
				\dash\notif::ok(T_("File successfully deleted"));
				\dash\redirect::pwd();
				return;
			}
		}
		else
		{
			\dash\notif::ok(T_("Dont!"));
			return false;
		}
	}

	public static function backup_now($_db_name = null)
	{
		if(\dash\db\mysql\tools\backup::backup_dump(['download' => false, 'db_name' => $_db_name]))
		{
			\dash\notif::ok(T_("Backup complete"));
		}
		\dash\redirect::pwd();
	}
}
?>
