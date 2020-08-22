<?php
namespace content_a\setting\sms;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting SMS'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}

}
?>
