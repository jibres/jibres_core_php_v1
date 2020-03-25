<?php
namespace content\terms\irnic;


class view
{
	public static function config()
	{
		\dash\face::title(T_('IRNIC - Dot-IR (.ir) ccTLD Registry Agreement'));
		\dash\face::desc(T_('Text of agreement for registering domains under .ir and .ایران.ir '));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>