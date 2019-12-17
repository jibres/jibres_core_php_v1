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
			$sms = "سپاس از بازدیدتان از غرفه‌ی جیبرس". "\n";
			$sms .= "به دنیای جیبرس خوش آمدید". "\n\n";
			$sms .= "اپلیکیشن + وب‌سایت فروشگاهی + فروش حضوری + فروش در شبکه‌های اجتماعی". "\n";
			$sms .= "در همه بسترهای ممکن  یکپارچه بفروشید و لذت ببرید". "\n\n";
			$sms .= "Jibres.com";
			if(\dash\utility\filter::ir_mobile($mobile))
			{
				\dash\utility\sms::send($mobile, $sms);
			}
		}
	}
}
?>
