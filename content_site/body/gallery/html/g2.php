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
					$sliderBox = array_slice($_image_list, 4);

					// slider box
					$html .= '<div class="row-span-2 col-span-2">';
					{
						$html .= '<div class="h-full" data-slider>';
						{
							$html .= \content_site\assemble\element\magicbox::html($_args, $sliderBox);
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