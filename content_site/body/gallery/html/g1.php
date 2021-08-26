<?php
namespace content_site\body\gallery\html;


class g1
{
	public static function html($_args, $_image_list)
	{
		$html             = '';

		// define variables
		$color_heading    = a($_args, 'color_heading:full_style');
		$heading_class    = a($_args, 'heading:class');

		$html .= \content_site\assemble\element\section::element_start($_args);
		{
			$container = a($_args, 'container:class');
			$html .= "<div class='$container m-auto relative'>";
			{
				// if(a($_args, 'heading') !== null)
				// {
				// 	$html .= '<header>';
				// 	{
				// 		$html .= "<h2 class='text-3xl font-black leading-6 mb-5 $heading_class' $color_heading>";
				// 		{
				// 			$html .= a($_args, 'heading');
				// 		}
				// 		$html .= '</h2>';
				// 	}
				// 	$html .= '</header>';
				// }


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