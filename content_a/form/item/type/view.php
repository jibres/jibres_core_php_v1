<?php
namespace content_a\form\item\type;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit item type'));


		\content_a\form\edit\view::form_preview_link();

		\dash\data::back_link(\dash\url::this(). '/item?'. \dash\request::fix_get());

		\dash\data::itemType(\lib\app\form\item\type::get_group());

	}
}
