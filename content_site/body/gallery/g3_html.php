<?php
namespace content_site\body\gallery;


class g3_html
{
	public static function html($_args, $_image_list)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				// $html .= \content_site\assemble\wrench\heading::simple1($_args);

				$html .= \content_site\assemble\wrench\section::grid_by_count($_args, 6);
				{
					$normalList = array_slice($_image_list, 0, 2);
					$sliderList = array_slice($_image_list, 2);

					// slider box
					$html .= '<div class="row-span-2 col-span-6 md:col-span-4">';
					{
						$html .= \content_site\assemble\element\slider::html($_args, $sliderList);
					}
					$html .= '</div>';

					$otherItemClass =
					[
						0 => 'col-span-3 md:col-span-2',
						1 => 'col-span-3 md:col-span-2',
						2 => 'col-span-3 md:col-span-2',
						3 => 'col-span-3 md:col-span-2',
					];
					$html .= \content_site\assemble\element\magicbox::html($_args, $normalList, $otherItemClass);
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