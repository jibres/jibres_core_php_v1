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
			$zip_addr  = __DIR__.'/';
			$file_name = 'Backup_database.me.zip';
			$zip       = \dash\utility\zip::folder($zip_addr. $file_name, database. 'backup/file/'. $zipdownload);
			\dash\log::set('downloadBackupZip');
			\dash\file::download($zip_addr. $file_name);
			return;
		}
	}
}
?>