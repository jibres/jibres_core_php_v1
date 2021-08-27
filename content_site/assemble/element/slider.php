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
		if(a($_args, 'slider_effect'))
		{
			$html .= ' data-effect="'. a($_args, 'slider_effect'). '"';
		}
		if(\dash\language::dir() === 'rtl')
		{
			$html .= ' dir="rtl"';
		}
		$html .= '>';
		{
			$html .= '<div class="swiper-wrapper">';
			{
				$specialAttr = "class='swiper-slide'";
				$autoplay = a($_args, 'slider_autoplay');
				$autoplayDelay = 5000;
				if($autoplay && $autoplay >= 0 && $autoplay <= 10)
				{
					$autoplayDelay = $autoplay * 1000;
				}
				elseif($autoplay === 'disable')
				{
					$autoplayDelay = 0;
				}

				// set autoplay
				if($autoplayDelay)
				{
					$specialAttr .= ' data-swiper-autoplay="'. $autoplayDelay. '"';
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

			if(a($_args, 'slider_pagination'))
			{
				$html .= '<div class="swiper-pagination"></div>';
			}
			if(a($_args, 'slider_next_prev'))
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