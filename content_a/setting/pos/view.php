<?php
namespace content_a\setting\pos;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Point of sale hardwares'));

		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());
	}
}
?>
