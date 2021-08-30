<?php
namespace content_site\body\product;


class p3_html
{
	public static function html($_args, $_list)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				$html .= \content_site\assemble\wrench\heading::simple1($_args);

				// $html .= \content_site\assemble\wrench\section::grid_12($_args);
				$html .= '<div class="">';
				{
					$html .= \content_site\assemble\element\slider::html($_args, $_list, 'card');
				}
				$html .= '</div>';

				$html .= \content_site\body\blog\share::btn_viewall($_args);
			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>