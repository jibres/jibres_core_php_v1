<?php
namespace content_site\body\gallery;


class g4_html
{
	public static function html($_args, $_image_list)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				// $html .= \content_site\assemble\wrench\heading::simple1($_args);

				$html .= \content_site\assemble\wrench\section::grid_by_count($_args, 1);
				{

					// slider box
					$html .= '<div class="">';
					{
						$html .= \content_site\assemble\element\slider::html($_args, $_image_list);
					}
					$html .= '</div>';
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