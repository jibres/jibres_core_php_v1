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
			\dash\data::back_text(T_('Slider list'));
			\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::quoteID());
		}
		else
		{

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '?id='. \dash\data::quoteID());
		}

		\dash\data::defaultRatioSlider(\lib\app\website\body\line\quote::default_ratio('title'));

		\dash\data::quoteNameSuggestion(\lib\app\website\body\line\quote::suggest_new_name());


		if(\dash\data::lineSetting_quote() && is_array(\dash\data::lineSetting_quote()))
		{
			$quote = \dash\data::lineSetting_quote();
			foreach ($quote as $key => $value)
			{
				$quote[$key]['edit_link'] = \dash\url::this(). '/quote/edit?id='. \dash\data::quoteID(). '&index='. $key;
			}

			// $quote[] =
			// [
			// 	'image'  => \dash\url::icon(),
			// 	'edit_link'    => \dash\url::this(). '/quote/add?id='. \dash\data::quoteID(),
			// 	'alt'    => null,
			// 	'sort'   => null,
			// 	'target' => null,
			// 	'mod'    => 'add',
			// ];

			\dash\data::lineSetting_quote($quote);
		}
	}
}
?>
