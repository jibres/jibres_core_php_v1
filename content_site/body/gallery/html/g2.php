<?php
namespace content_site\body\gallery\html;


class g2
{
	public static function html($_args, $_image_list)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				// $html .= \content_site\assemble\wrench\heading::simple1($_args);

				$html .= \content_site\assemble\wrench\section::grid_by_count($_args, 4);
				{
					$normalBox = array_slice($_image_list, 0, 4);
					$sliderBox = array_slice($_image_list, 3);

					// slider box
					$html .= '<div class="row-span-2 col-span-2">';
					{
						$sliderClass = 'swiper h-full';
						if(a($_args, 'radius:class'))
						{
							$sliderClass .= ' overflow-hidden1 '. a($_args, 'radius:class');
						}
						$html .= '<div class="'. $sliderClass. '" data-swiper>';
						{
							$html .= '<div class="swiper-wrapper">';
							{
								$html .= \content_site\assemble\element\magicbox::html($_args, $sliderBox, 'slider');
							}
							$html .= '</div>';
							$html .= '<div class="swiper-pagination"></div>';
							$html .= '<div class="swiper-button-prev"></div>';
							$html .= '<div class="swiper-button-next"></div>';
							// $html .= '<div class="swiper-scrollbar"></div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

					$html .= \content_site\assemble\element\magicbox::html($_args, $normalBox);
				}
				$html .= '</div>';
			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>