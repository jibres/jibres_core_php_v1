<?php
namespace content_a\setting\logo;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Set logo of your store'));
		if(!\dash\data::dataRow_logo())
		{
			\dash\data::dataRow_logo(\dash\app::static_logo_url());
		}

		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());
	}
}
?>
