<?php
namespace content\subscribe;


class model
{
	public static function post()
	{

		$mobile = \dash\request::post('mobile');

		$add_user =
		[
			'mobile'      => $mobile,
			'displayname' => \dash\request::post('name'),
			'email'       => \dash\request::post('email'),
			'subscribe'   => 1,
		];

		$add = \dash\app\user::add($add_user);

		if(isset($add['id']) || \dash\utility\filter::mobile($mobile) === '989109610612')
		{
			$sms = "سلام. به دنیای جیبرس خوش آمدید";
			if(\dash\utility\filter::ir_mobile($mobile))
			{
				\dash\utility\sms::send($mobile, $sms);
			}
		}
	}
}
?>
