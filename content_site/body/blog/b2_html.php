<?php
namespace content_site\body\blog;


class b2_html
{
	public static function html($_args, $_blogList)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container_auto($_args, a($_args, 'count'));
			{
				$html .= \content_site\assemble\wrench\heading::simple1($_args);

				$html .= \content_site\assemble\wrench\section::grid_12($_args);
				{
					$html .= \content_site\assemble\element\magicbox::html($_args, $_blogList, 'blog');
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