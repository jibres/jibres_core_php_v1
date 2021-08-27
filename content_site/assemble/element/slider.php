<?php
namespace content_site\assemble\element;


class slider
{
	public static function html($_args, $_datalist)
	{
		$sliderClass = 'swiper h-full';
		if(a($_args, 'radius:class'))
		{
			$sliderClass .= ' overflow-hidden '. a($_args, 'radius:class');
		}
		$html = '<div class="'. $sliderClass. '" data-swiper';
		if(\dash\language::dir() === 'rtl')
		{
			$html .= ' dir="rtl"';
		}
		$html .= '>';
		{
			$html .= '<div class="swiper-wrapper">';
			{
				$specialAttr = "class='swiper-slide'";
				if(a($_args, 'magicbox_autoplay'))
				{
					$time = 2000;
					$specialAttr .= ' data-swiper-autoplay="'. $time. '"';
				}
				// create attr array
				$sliderOption =
				[
					'type' => 'slider',
					'attr' => $specialAttr,
				];

				$html .= \content_site\assemble\element\magicbox::html($_args, $_datalist, $sliderOption);
			}
			$html .= '</div>';

			if(1)
			{
				$html .= '<div class="swiper-pagination"></div>';
			}
			if(1)
			{
				$html .= '<div class="swiper-button-prev"></div>';
				$html .= '<div class="swiper-button-next"></div>';
			}
			// $html .= '<div class="swiper-scrollbar"></div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>