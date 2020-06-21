<?php
namespace content_a\setting\payment;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Payment'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>
