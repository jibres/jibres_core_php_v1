<?php
namespace content_a\setting\payment;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Payment channels'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>
