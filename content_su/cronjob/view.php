<?php
namespace content_su\cronjob;


class view
{
	public static function config()
	{
		if(\dash\request::get('download') === 'crontabme')
		{
			\dash\file::download(core. '/engine/cronjob/exec.me.php');
		}

		\dash\data::cronjob(\dash\engine\cronjob\options::status());
		\dash\data::cronjobPHP(\dash\engine\cronjob\options::current_cronjob_path());

		$unixcrontab = \dash\engine\cronjob\options::unixcrontab();
		\dash\data::unixcrontab($unixcrontab);


	}
}
?>