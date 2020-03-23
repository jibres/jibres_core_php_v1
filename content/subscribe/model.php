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

		if(isset($add['id']))
		{
			$sms = "سپاس از بازدیدتان از غرفه جیبرس". "\n";
			$sms .= "به دنیای جیبرس خوش آمدید.". "\n\n";
			$sms .= "اپلیکیشن، وب‌سایت فروشگاهی، فروش حضوری، فروش در شبکه های اجتماعی". "\n";
			$sms .= "ما امکان فروش رو برای شما در تمام بسترهای ممکن فراهم کرده ایم". "\n\n";
			$sms .= "Jibres.com";
			if(\dash\validate::ir_mobile($mobile, false))
			{
				\dash\utility\sms::send($mobile, $sms);
			}
		}
	}
}
?>
