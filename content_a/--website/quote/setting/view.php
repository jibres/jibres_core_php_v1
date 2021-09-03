<?php
namespace content_a\website\quote\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage quote'));

		if(\dash\data::quoteID())
		{
			// back
			\dash\data::back_text(T_('Quote list'));
			\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::quoteID());
		}
		else
		{

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '?id='. \dash\data::quoteID());
		}

		\dash\data::defaultStyleQuote(\lib\app\website\body\line\quote::default_style('title'));

		\dash\data::quoteNameSuggestion(\lib\app\website\body\line\quote::suggest_new_name());

	}
}
?>
