<?php
namespace content_a\website\news;


class view
{
	public static function config()
	{
		\dash\face::title(T_('News line'));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

		\dash\data::nameSuggestion(\lib\app\website\body\line\datablock::suggest_new_name(T_("News")));


	}
}
?>
