<?php
namespace content_a\setting\thirdparty\kavenegar;


class model
{
	public static function post()
	{
		$post           = [];
		$post['kavenegar_apikey'] = \dash\request::post('kavenegar_apikey');

		\lib\app\setting\set::sms_setting($post);

		\dash\redirect::pwd();
	}
}
?>