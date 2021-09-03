<?php
namespace content_a\website\subscribe;


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
			\dash\face::title(T_('Text'));
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

		\dash\data::textNameSuggestion(\lib\app\website\body\line\subscribe::suggest_new_name());

	}
}
?>
