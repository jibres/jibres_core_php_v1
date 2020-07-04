<?php
namespace content_enter\okay;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Login successfully'));

		\dash\face::desc(T_('Live and learn'));

		\dash\utility\cookie::write('login', 'yes', (86400 * 30), null, null, null, false);


		\dash\data::redirectUrl(\dash\url::kingdom());
		if(\dash\utility\enter::get_session('redirect_url'))
		{
			\dash\data::redirectUrl(\dash\utility\enter::get_session('redirect_url'));
		}

		\dash\utility\enter::clean_session();

		\dash\redirect::to(\dash\data::redirectUrl());
	}
}
?>