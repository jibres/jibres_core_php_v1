<?php
namespace content_su\backup;


class view
{
	public static function config()
	{

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		$configBackup = @\dash\file::read(database. 'backup/schedule.json');
		if($configBackup && is_string($configBackup))
		{
			$configBackup = json_decode($configBackup, true);
			\dash\data::configBackup($configBackup);
		}


		\dash\data::mysqlInfo(\dash\db::global_status());

		$folder    = null;
		$subfolder = null;

		if(\dash\request::get('folder'))
		{
			$folder = \dash\request::get('folder');
		}

		if(\dash\request::get('subfolder'))
		{
			$subfolder = \dash\request::get('subfolder');
		}

		$addr = [];
		$addr[] = $folder;
		$addr[] = $subfolder;
		$addr[] = '*';
		$addr = array_filter($addr);
		$addr = implode('/', $addr);

		$backup_addr = YARD. 'jibres_backup/database/';

		$oldBackup = @glob($backup_addr. $addr);

		$oldBackup_files = [];

		if($oldBackup && is_array($oldBackup))
		{
			foreach ($oldBackup as $key => $value)
			{
				if(is_dir($value))
				{
					$myFolder    = null;
					$mySubfolder = null;

					if(\dash\request::get('folder'))
					{
						$myFolder = \dash\request::get('folder');
					}

					if($myFolder)
					{
						$mySubfolder = basename($value);
					}

					$oldBackup_files [] =
					[
						'name'      => basename($value),
						'type'      => 'folder',
						'addr'      => str_replace($backup_addr, '', $value),
						'folder'    => $myFolder ? $myFolder : basename($value),
						'subfolder' => $mySubfolder,
					];
				}
				else
				{
					$oldBackup_files [] =
					[
						'type' => 'file',
						'name' => basename($value),
						'time' => filemtime($value),
						'size' => round(filesize($value) / 1024 / 1024, 1),
						'date' => date("Y-m-d H:i:s", filemtime($value)),
						'addr' => str_replace(database .'backup/file/', '', $value),
						'ago'  => \dash\utility\human::timing(date("Y-m-d H:i:s", filemtime($value))),
					];

				}
			}
			$oldBackup_files = array_reverse($oldBackup_files);
			\dash\data::oldBackup($oldBackup_files);
		}
	}
}
?>