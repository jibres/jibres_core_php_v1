<?php
namespace content_a\website\slider;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Slider'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::sliderID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/slider/setting?id='. \dash\data::sliderID());
			// action
			\dash\data::action_text(T_('Add slider'));
			\dash\data::action_link(\dash\url::this(). '/slider/add?id='. \dash\data::sliderID());
		}


		if(\dash\data::lineSetting_slider() && is_array(\dash\data::lineSetting_slider()))
		{
			$slider = \dash\data::lineSetting_slider();
			foreach ($slider as $key => $value)
			{
				$slider[$key]['edit_link'] = \dash\url::this(). '/slider/edit?id='. \dash\data::sliderID(). '&index='. $key;
			}

			\dash\data::lineSetting_slider($slider);
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/slider/add');
		}
	}
}
?>
