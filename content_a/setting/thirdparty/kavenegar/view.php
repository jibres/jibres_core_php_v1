<?php
namespace content_a\setting\thirdparty\kavenegar;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Kavenegar API'));

		// back
		\dash\data::back_text(T_('Thirdparty'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::smsSettingSaved(\lib\app\setting\get::sms_setting());

	}
}
?>