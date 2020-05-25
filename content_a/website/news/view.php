<?php
namespace content_a\website\news;


class view
{
	public static function config()
	{
		if(\dash\data::lineSetting_title() && !\dash\detect\device::detectPWA())
		{
			\dash\face::title(\dash\data::lineSetting_title());
		}
		else
		{
			\dash\face::title(T_('Products'));
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

		\dash\data::defaultProductLineType(T_("Latest product (Default)"));

		\dash\data::newsNameSuggestion(\lib\app\website\body\line\news::suggest_new_name());

		\dash\data::listCategory(\dash\app\term::cat_list());


	}
}
?>
