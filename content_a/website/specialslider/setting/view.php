<?php
namespace content_a\website\specialslider\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage specialslider'));

		if(\dash\data::specialsliderID())
		{
			// back
			\dash\data::back_text(T_('SpecialSlider list'));
			\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::specialsliderID());
		}
		else
		{

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '?id='. \dash\data::specialsliderID());
		}

		\dash\data::defaultRatioSpecialSlider(\lib\app\website\body\line\specialslider::default_ratio('title'));

		\dash\data::specialsliderNameSuggestion(\lib\app\website\body\line\specialslider::suggest_new_name());


		if(\dash\data::lineSetting_specialslider() && is_array(\dash\data::lineSetting_specialslider()))
		{
			$specialslider = \dash\data::lineSetting_specialslider();
			foreach ($specialslider as $key => $value)
			{
				$specialslider[$key]['edit_link'] = \dash\url::this(). '/specialslider/edit?id='. \dash\data::specialsliderID(). '&index='. $key;
			}

			// $specialslider[] =
			// [
			// 	'image'  => \dash\url::icon(),
			// 	'edit_link'    => \dash\url::this(). '/specialslider/add?id='. \dash\data::specialsliderID(),
			// 	'alt'    => null,
			// 	'sort'   => null,
			// 	'target' => null,
			// 	'mod'    => 'add',
			// ];

			\dash\data::lineSetting_specialslider($specialslider);
		}
	}
}
?>
