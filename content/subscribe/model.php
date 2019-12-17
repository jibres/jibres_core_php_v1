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

		if(isset($add['id']) || \dash\utility\filter::mobile($mobile) === '989109610612' || \dash\utility\filter::mobile($mobile) === '989357269759')
		{
			$sms = "سپاس از بازدیدتان از غرفه جیبرس". "\n";
			$sms .= "به دنیای جیبرس خوش آمدید.". "\n\n";
			$sms .= "اپلیکیشن، وب‌سایت فروشگاهی، فروش حضوری، فروش در شبکه های اجتماعی". "\n";
			$sms .= "ما امکان فروش رو برای شما در تمام بسترهای ممکن فراهم کرده ایم". "\n\n";
			$sms .= "Jibres.com";
			if(\dash\utility\filter::ir_mobile($mobile))
			{
				\dash\utility\sms::send($mobile, $sms);
			}
		}
	}
}
?>
