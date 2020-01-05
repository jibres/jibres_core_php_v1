<?php
namespace content_su\backup\import;

class controller
{
	public static function routing()
	{
		if(!\dash\url::isLocal())
		{
			\dash\header::status(400, 'This page only route in local');
		}

		$directory = \dash\url::directory();
		$directory = str_replace('backup/import', '', $directory);

		if(!is_dir($directory))
		{
			\dash\notif::api('Not found directory '. $directory);
		}

		$list = glob($directory. '/*');
		if(empty($list))
		{
			\dash\notif::api('Directory is empty');
		}

		$i = 0;
		\dash\file::write(__DIR__. '/exec.me.sql', ' ');

		foreach ($list as $key => $db_backup_file)
		{
			if(preg_match("/(jibres\_\d{7})/", $db_backup_file, $split))
			{
				$i++;
				$db_name = $split[1];
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`'.$db_name.'\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`'.$db_name.'\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot '. $db_name. "\n");

			}
			elseif(preg_match("/(jibres_2020)/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`jibres\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`jibres\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot jibres'. "\n");
			}
		}

		\dash\notif::api('Run this code : sh '. __DIR__. '/exec.me.sql');

	}
}
?>