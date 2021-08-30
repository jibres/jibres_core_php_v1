<?php
namespace content_site\body\gallery;


class g2_html
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
					$normalList = array_slice($_image_list, 0, 4);
					$sliderList = array_slice($_image_list, 4);

					// slider box
					$html .= '<div class="row-span-2 col-span-4 md:col-span-2">';
					{
						$html .= \content_site\assemble\element\slider::html($_args, $sliderList);
					}
					$html .= '</div>';

					$magicBoxOpt =
					[
						'class' =>
						[
							0 => 'col-span-2 md:col-span-1',
							1 => 'col-span-2 md:col-span-1',
							2 => 'col-span-2 md:col-span-1',
							3 => 'col-span-2 md:col-span-1',
						]
					];
					$html .= \content_site\assemble\element\magicbox::html($_args, $normalList, $magicBoxOpt);
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