<?php
namespace content_a\setting\sms\kavenegar;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Kavenegar API'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this(). '/sms');

		\dash\data::smsSettingSaved(\lib\app\setting\get::sms_setting());

	}
}
?>