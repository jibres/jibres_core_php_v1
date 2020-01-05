<?php
namespace content_a\setting\company;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Store legal information'));

		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());
	}
}
?>
