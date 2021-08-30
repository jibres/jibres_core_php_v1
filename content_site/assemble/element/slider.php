<?php
namespace content_site\assemble\element;


class slider
{
	public static function html($_args, $_datalist, $_multiInRow = null)
	{
		$sliderClass = 'swiper h-full';
		if(a($_args, 'radius:class'))
		{
			$sliderClass .= ' overflow-hidden '. a($_args, 'radius:class');
		}
		$html = '<div class="'. $sliderClass. '" data-swiper';
		if($_multiInRow)
		{
			$html .= ' data-slidesPerView="auto"';
		}
		$effect = a($_args, 'slider_effect');
		if(!$effect)
		{
			$effect = 'slide';
		}
		$html .= ' data-effect="'. $effect. '"';

		if(\dash\language::dir() === 'rtl')
		{
			$html .= ' dir="rtl"';
		}
		$html .= '>';
		{
			$html .= '<div class="swiper-wrapper">';
			{
				$autoplay = a($_args, 'slider_autoplay');
				$autoplayDelay = null;
				if($autoplay && $autoplay >= 0 && $autoplay <= 10)
				{
					$autoplayDelay = $autoplay * 1000;
				}
				elseif($autoplay === 'disable')
				{
					$autoplayDelay = 0;
				}

				// set class of each slide
				$specialAttr = "class='swiper-slide'";
				if($_multiInRow)
				{
					// set margin
					$slideMarginClass = 'p-0.5 md:p-1';

					switch (a($_args, 'slider_size'))
					{
						case 'sm':
							$slideSizeClass = 'w-2/6 md:w-1/5 lg:w-1/6';
							break;

						default:
						case 'md':
							$slideSizeClass = 'w-3/6 md:w-1/4 lg:w-1/5';
							break;

						case 'lg':
							$slideSizeClass = 'w-4/6 md:w-1/3 lg:w-1/4';
							break;


						case 'xl':
							$slideSizeClass = 'w-5/6 md:w-1/2 lg:w-1/3';
							break;

							break;
					}

					$specialAttr = "class='swiper-slide $slideSizeClass $slideMarginClass'";
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
					// 'attr' => $specialAttr,
				];

				foreach ($_datalist as $key => $item)
				{
					$html .= "<div $specialAttr>";
					{
						if($_multiInRow === 'card')
						{

						}
						else
						{
							$html .= \content_site\assemble\element\magicbox::eachItem($_args, $_datalist, $sliderOption, $key, $item);
						}
					}
					$html .= '</div>';

				}

				// if($_multiInRow === 'card')
				// {
				// 	$html .= \content_site\assemble\element\card::html($_args, $_datalist);
				// }
				// else
				// {
				// 	$html .= \content_site\assemble\element\magicbox::html($_args, $_datalist, $sliderOption);
				// }
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