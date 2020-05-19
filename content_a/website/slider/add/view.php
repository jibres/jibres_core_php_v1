<?php
namespace content_a\website\slider\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add slider page'));

		if(\dash\data::sliderID())
		{
			// back
			\dash\data::back_text(T_('Slider list'));
			\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::sliderID());
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}



		if(\dash\data::lineSetting_slider() && is_array(\dash\data::lineSetting_slider()))
		{
			$slider = \dash\data::lineSetting_slider();
			foreach ($slider as $key => $value)
			{
				$slider[$key]['edit_link'] = \dash\url::this(). '/slider/edit?id='. \dash\data::sliderID(). '&index='. $key;
			}

			// $slider[] =
			// [
			// 	'image'  => \dash\url::icon(),
			// 	'edit_link'    => \dash\url::this(). '/slider/add?id='. \dash\data::sliderID(),
			// 	'alt'    => null,
			// 	'sort'   => null,
			// 	'target' => null,
			// 	'mod'    => 'add',
			// ];

			\dash\data::lineSetting_slider($slider);
		}
	}
}
?>
