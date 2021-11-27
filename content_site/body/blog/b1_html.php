<?php
namespace content_site\body\blog;


class b1_html
{
	public static function html($_args, $_blogList)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				$link = null;

				if(!a($_args, 'btn_viewall_check') && a($_args, 'btn_viewall_link'))
				{
					$link = $_args['btn_viewall_link'];
				}

				$html .= \content_site\assemble\wrench\heading::simple1($_args, $link);

				$html .= \content_site\assemble\wrench\section::grid_12($_args);
				{
					$optCard = [
						'grid' => true,
					];
					$html .= \content_site\assemble\element\card::html($_args, $_blogList, $optCard);
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