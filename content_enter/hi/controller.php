<?php
namespace content_enter\hi;


class controller
{
	public static function routing()
	{
		if(!\dash\request::is('post'))
		{
			\dash\redirect::to(\dash\url::kingdom(). '/enter');
		}

		$mobile = \dash\request::post('mobile');

		if(!$mobile)
		{
			\dash\notif::error(T_("Please enter your mobile"), 'mobile');
			\dash\code::end();
			return;
		}

		$mobile = \dash\validate::mobile($mobile, false);

		if(!$mobile)
		{
			\dash\notif::error(T_("Invalid mobile, Please enter a valid mobile"), 'mobile');
			\dash\code::end();
			return;
		}

		$get             = [];
		$get['autosend'] = 1;
		$get['go']       = 1;
		$get['mobile']   = $mobile;

		$url = \dash\url::kingdom(). '/enter?'. \dash\request::fix_get($get);
		\dash\redirect::to($url);


	}
}
?>