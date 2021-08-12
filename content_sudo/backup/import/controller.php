<?php
namespace content_sudo\backup\import;

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

			if(preg_match("/(jibres_202)/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','date && echo '. $db_backup_file. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`jibres\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`jibres\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot jibres'. "\n");
			}
			elseif(preg_match("/(jibres_nic_202)/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','date && echo '. $db_backup_file. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`jibres_nic\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`jibres_nic\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot jibres_nic'. "\n");
			}
			elseif(preg_match("/(jibres_nic_log_202)/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','date && echo '. $db_backup_file. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`jibres_nic_log\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`jibres_nic_log\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot jibres_nic_log'. "\n");
			}
			elseif(preg_match("/(jibres_onlinenic_log_202)/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','date && echo '. $db_backup_file. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`jibres_onlinenic_log\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`jibres_onlinenic_log\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot jibres_onlinenic_log'. "\n");
			}
			elseif(preg_match("/(jibres_shaparak_log_202)/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','date && echo '. $db_backup_file. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`jibres_shaparak_log\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`jibres_shaparak_log\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot jibres_shaparak_log'. "\n");
			}
			elseif(preg_match("/(jibres_shaparak_202)/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','date && echo '. $db_backup_file. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`jibres_shaparak\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`jibres_shaparak\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot jibres_shaparak'. "\n");
			}
		}

		foreach ($list as $key => $db_backup_file)
		{
			if(preg_match("/(business\_\d{7})/", $db_backup_file, $split))
			{
				$i++;
				\dash\file::append(__DIR__. '/exec.me.sql','date && echo '. $db_backup_file. "\n");
				$db_name = $split[1];
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "DROP DATABASE \`'.$db_name.'\`"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`'.$db_name.'\` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"'. "\n");
				\dash\file::append(__DIR__. '/exec.me.sql','bunzip2 < '.$db_backup_file.' | mysql -uroot -proot '. $db_name. "\n");

			}
		}

		\dash\file::write(__DIR__. '/exec.me.for-javad.sql', str_replace('-uroot -proot', '-ureza -proot -h192.168.1.80', \dash\file::read( __DIR__. '/exec.me.sql')));
		\dash\notif::api(["Run this code : ","sh ". __DIR__. "/exec.me.sql ","sh ".__DIR__. "/exec.me.for-javad.sql"]);


	}
}
?>