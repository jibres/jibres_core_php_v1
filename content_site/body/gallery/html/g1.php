<?php
namespace content_site\body\gallery\html;


class g1
{
	public static function html($_args, $_image_list)
	{
		$html = \content_site\assemble\element\section::element_start($_args);
		{
			$container = a($_args, 'container:class');
			$html .= "<div class='$container m-auto relative'>";
			{
				// $html .= \content_site\assemble\element\heading::simple1($_args);

				$grid_cols = 'grid grid-cols-'. count($_image_list);
				if(count($_image_list) > 12)
				{
					$grid_cols = 'grid grid-cols-'. 12;
				}
				if(a($_args, 'magicbox_gap:class'))
				{
					$grid_cols .=	' '. a($_args, 'magicbox_gap:class');
				}

				$html .= "<div class='$grid_cols'>";
				{
					$html .= \content_site\assemble\element\magicbox::html($_args, $_image_list);
				}
				$html .= '</div>';
			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\element\section::element_end($_args);

		return $html;
	}
}
?>