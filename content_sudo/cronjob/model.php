<?php
namespace content_sudo\cronjob;

class model
{
	public static function post()
	{
		if(\dash\request::post('jibres_while_true'))
		{
			if(\dash\request::post('jibres_while_true') === 'force_stop')
			{
				\lib\app\loop\run::force_stop(true);
			}

			if(\dash\request::post('jibres_while_true') === 'start')
			{
				\lib\app\loop\run::force_stop(false);
			}
			\dash\redirect::pwd();

			return ;
		}

		$post = \dash\request::post();

		if(\dash\request::post('active'))
		{
			\dash\log::set('cronJobChange');
			\dash\engine\cronjob\options::active();
			\dash\notif::ok(T_("Your cronjob is actived"));
		}
		else
		{
			\dash\log::set('cronJobDeactive');
			\dash\engine\cronjob\options::deactive();
			\dash\notif::ok(T_("Your cronjob is deactived"));
		}

		\dash\redirect::pwd();
	}
}
?>
