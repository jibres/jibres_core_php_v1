<?php
namespace content_a\setting\whatsapp;

class view
{
	public static function config()
	{
		\dash\face::title(T_('WhatsApp'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');
	}
}
?>