<?php
namespace content_enter\alert;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Alert!'));

		\dash\face::desc(\dash\face::title());


		$alert = \dash\utility\enter::get_session('alert');

		\dash\data::alertMsg(T_("Alert!"). ' '. T_("What are you doing?"));
		if(isset($alert['text']))
		{
			\dash\data::alertMsg($alert['text']);
		}

		\dash\data::alertLink(\dash\url::here());
		if(isset($alert['link']))
		{
			\dash\data::alertLink($alert['link']);
		}

		\dash\data::alertButton(T_("OK"));
		if(isset($alert['button']))
		{
			\dash\data::alertButton($alert['button']);
		}
		\dash\log::set('viewAlert', ['msg' => \dash\data::alertMsg()]);

		if(isset($alert['clean_session']) && $alert['clean_session'])
		{
			\dash\utility\enter::clean_session();
		}
	}
}
?>