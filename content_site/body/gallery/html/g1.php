<?php
namespace content_site\body\gallery\html;


class g1
{
	public static function html($_args, $_image_list)
	{
		$html             = '';

		// define variables
		$background_style = a($_args, 'background:full_style');
		$color_heading    = a($_args, 'color_heading:full_style');
		$section_id       = a($_args, 'secition:id');
		$heading_class    = a($_args, 'heading:class');

		// element type
		$cnElement = 'div';
		if(a($_args, 'heading') !== null)
		{
			$cnElement = 'section';
		}

		$classNames = 'flex overflow-hidden';
		if(a($_args, 'height:class'))
		{
			$classNames .= ' '. a($_args, 'height:class');
		}
		if(a($_args, 'font:class'))
		{
			$classNames .= ' '. a($_args, 'font:class');
		}

		$html .= "<$cnElement data-type='". a($_args, 'type'). "' class='$classNames'$background_style $section_id>";
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
		$html .= "</$cnElement>";


		return $html;
	}
}
?>