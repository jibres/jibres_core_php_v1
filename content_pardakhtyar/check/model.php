<?php
namespace content_pardakhtyar\check;


class model
{
	public static function post()
	{
		if(\dash\request::post('requestType') == 13)
		{
			\lib\pardakhtyar\app\shaparak\request::type_13(\dash\request::post());
		}
		elseif(\dash\request::post('fetch') == 1)
		{
			\lib\pardakhtyar\app\shaparak\request::fetch(\dash\request::post());
		}
		\dash\redirect::pwd();
	}
}
?>