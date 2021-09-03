<?php
namespace content_a\website\specialslider\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add special slider page'));


		if(\dash\data::specialsliderID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/specialslider/setting?id='. \dash\data::specialsliderID());


			if(\dash\data::lineSetting_specialslider() && is_array(\dash\data::lineSetting_specialslider()))
			{
				// back
				\dash\data::back_text(T_('Special Slider list'));
				\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::specialsliderID());

			}
			else
			{
				// back
				\dash\data::back_text(T_('Website body'));
				\dash\data::back_link(\dash\url::this(). '/body');
			}
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/body');
			\dash\face::btnSetting(\dash\url::this(). '/specialslider/setting');
		}

		\lib\ratio::data_ratio_html(\dash\data::lineSetting_ratio());


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
