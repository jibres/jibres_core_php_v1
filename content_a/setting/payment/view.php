<?php
namespace content_a\setting\payment;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Payment channels'));

		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());
	}
}
?>
