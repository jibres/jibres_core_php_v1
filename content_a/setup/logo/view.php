<?php
namespace content_a\setup\logo;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Set logo of your store'));
		if(!\dash\data::dataRow_logo())
		{
			\dash\data::dataRow_logo(\dash\app::static_logo_url());
		}
	}
}
?>
