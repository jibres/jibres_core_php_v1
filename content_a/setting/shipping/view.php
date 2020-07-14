<?php
namespace content_a\setting\shipping;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting up shipping rates'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}

}
?>
