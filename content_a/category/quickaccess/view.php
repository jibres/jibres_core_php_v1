<?php
namespace content_a\category\quickaccess;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Set quick access to category in sale page'));

		\dash\data::back_text(T_('Categories'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>