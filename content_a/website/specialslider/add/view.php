<?php
namespace content_a\website\specialslider\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add specialslider page'));


		if(\dash\data::specialsliderID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/specialslider/setting?id='. \dash\data::specialsliderID());


			if(\dash\data::lineSetting_specialslider() && is_array(\dash\data::lineSetting_specialslider()))
			{
				// back
				\dash\data::back_text(T_('SpecialSlider list'));
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

		$ratio = \lib\app\website\body\line\specialslider::ratio(\dash\data::lineSetting());
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
