<?php
namespace content_a\category\add;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Add new category'));
		\dash\data::page_desc(T_('You can add new category.'));
		\dash\data::page_pictogram('plus');


		\dash\data::back_text(T_('Category list'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>