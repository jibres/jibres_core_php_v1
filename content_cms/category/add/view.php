<?php
namespace content_cms\category\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new category'));

		\dash\data::back_text(T_('Categories'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>