<?php
namespace content_a\category\sort;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sort Product categories'));

		\dash\data::back_text(T_('Categories'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>