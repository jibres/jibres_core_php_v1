<?php
namespace content_su\cronjob;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		if(\dash\request::get('download') === 'crontabme')
		{
			\dash\file::download(core. '/engine/cronjob/exec.me.php');
		}

		if(\dash\request::get('download') === 'result')
		{
			\dash\file::download(core. '/engine/cronjob/resultexect.me.log');
		}

		\dash\data::cronjob(\dash\engine\cronjob\options::status());
		\dash\data::cronjobPHP(\dash\engine\cronjob\options::current_cronjob_path());

		$unixcrontab = \dash\engine\cronjob\options::unixcrontab();
		\dash\data::unixcrontab($unixcrontab);


	}
}
?>