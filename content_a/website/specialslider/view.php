<?php
namespace content_a\website\specialslider;


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
			\dash\face::title(T_('SpecialSlider'));
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::specialsliderID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/specialslider/setting?id='. \dash\data::specialsliderID());
			// action
			\dash\data::action_text(T_('Add specialslider'));
			\dash\data::action_link(\dash\url::this(). '/specialslider/add?id='. \dash\data::specialsliderID());
		}


		if(\dash\data::lineSetting_specialslider() && is_array(\dash\data::lineSetting_specialslider()))
		{
			$specialslider = \dash\data::lineSetting_specialslider();
			foreach ($specialslider as $key => $value)
			{
				$specialslider[$key]['edit_link'] = \dash\url::this(). '/specialslider/edit?id='. \dash\data::specialsliderID(). '&index='. $key;
			}

			\dash\data::lineSetting_specialslider($specialslider);
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/specialslider/add?id='. \dash\data::specialsliderID());
		}
	}
}
?>
