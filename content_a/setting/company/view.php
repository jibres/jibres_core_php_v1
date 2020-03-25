<?php
namespace content_a\setting\company;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Store legal information'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>
