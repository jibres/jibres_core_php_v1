<?php
namespace content_su\backup;

class controller
{
	public static function routing()
	{

		$download = \dash\request::get('download');
		if($download && is_file(database. 'backup/file/'. $download))
		{
			\dash\log::set('downloadBackup');
			\dash\file::download(database. 'backup/file/'. $download);
			return;
		}

		$zipdownload = \dash\request::get('zipdownload');
		if($zipdownload && is_dir(database. 'backup/file/'. $zipdownload))
		{
			$zip_addr  = __DIR__.'/Backup_database.me.zip';

			\dash\file::delete($zip_addr);
			$zip       = \dash\utility\zip::folder($zip_addr, database. 'backup/file/'. $zipdownload. '/');
			\dash\log::set('downloadBackupZip');
			\dash\file::download($zip_addr);
			return;
		}
	}
}
?>