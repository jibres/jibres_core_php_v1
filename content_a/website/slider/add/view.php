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
			\dash\data::back_link(\dash\url::this(). '/body');
		}

		$ratio = \lib\app\website\body\line\slider::ratio(\dash\data::lineSetting());
		$ratioHtml = '';
		if(isset($ratio['ratio']))
		{
			$ratioHtml .= 'data-ratio="'. $ratio['ratio']. '" ';
		}

		if(isset($ratio['min_w']))
		{
			$ratioHtml .= 'data-min-w="'. $ratio['min_w']. '" ';
		}

		if(isset($ratio['min_h']))
		{
			$ratioHtml .= 'data-min-h="'. $ratio['min_h']. '" ';
		}

		if(isset($ratio['max_w']))
		{
			$ratioHtml .= 'data-max-w="'. $ratio['max_w']. '" ';
		}

		if(isset($ratio['max_h']))
		{
			$ratioHtml .= 'data-max-h="'. $ratio['max_h']. '" ';
		}

		\dash\data::ratioHtml($ratioHtml);


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
