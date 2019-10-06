<?php
namespace content_pardakhtyar\customer\home;


class model
{
	public static function post()
	{
		if(\dash\request::post('requestType') == 13)
		{
			\lib\pardakhtyar\app\shaparak\request::type_13(\dash\request::post());
			\dash\notif::ok('Add Request sended');
		}
		elseif(\dash\request::post('fetch') == 1)
		{
			\lib\pardakhtyar\app\shaparak\request::fetch(\dash\request::post());
			\dash\notif::ok('Fetch ok');
		}
		\dash\redirect::pwd();
	}
}
?>