<?php
namespace content_su\backup;

class controller
{
	public static function routing()
	{

		$download = \dash\request::get('download');

		if($download && is_file(YARD. 'jibres_backup/database/'. $download))
		{
			\dash\log::set('downloadBackup');
			\dash\file::download(YARD. 'jibres_backup/database/'. $download);
			return;
		}

		$zipdownload = \dash\request::get('zipdownload');

		if($zipdownload && is_dir(YARD. 'jibres_backup/database/'. $zipdownload))
		{
			$zip_dir = YARD . 'jibres_backup/download';

			if(!is_dir($zip_dir))
			{
				\dash\file::makeDir($zip_dir, null, true);
			}

			$zip_addr  = $zip_dir. '/Backup_download_now.zip';

			\dash\file::delete($zip_addr);

			$zip       = \dash\utility\zip::folder($zip_addr, YARD. 'jibres_backup/database/'. $zipdownload. '/');

			\dash\log::set('downloadBackupZip');

			\dash\file::download($zip_addr);
			return;
		}
	}
}
?>