<?php
namespace content_a\form\item\type;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit item type'));

			// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/item?'. \dash\request::fix_get());

		\dash\data::itemType(\lib\app\form\item\type::get_group());

	}
}
?>
