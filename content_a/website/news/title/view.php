<?php
namespace content_a\website\news\title;


class view
{
	public static function config()
	{
		\dash\face::title(T_('News line'));


		\dash\face::btnSave('formboxtitle');

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). \dash\request::full_get());


		\dash\data::nameSuggestion(\lib\app\website\body\line\news::suggest_new_name());

	}
}
?>
