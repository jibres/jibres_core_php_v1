<?php
namespace content_a\website\body\slider;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage slider'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::sliderID())
		{
			\dash\face::btnView(\dash\url::that(). '/slider/set?id='. \dash\data::sliderID());
			// action
			\dash\data::action_text(T_('Add slider'));
			\dash\data::action_link(\dash\url::that(). '/slider/add?id='. \dash\data::sliderID());
		}


		if(\dash\data::lineSetting_slider() && is_array(\dash\data::lineSetting_slider()))
		{
			$slider = \dash\data::lineSetting_slider();
			foreach ($slider as $key => $value)
			{
				$slider[$key]['edit_link'] = \dash\url::that(). '/slider/edit?id='. \dash\data::sliderID(). '&index='. $key;
			}

			// $slider[] =
			// [
			// 	'image'  => \dash\url::icon(),
			// 	'edit_link'    => \dash\url::that(). '/slider/add?id='. \dash\data::sliderID(),
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
