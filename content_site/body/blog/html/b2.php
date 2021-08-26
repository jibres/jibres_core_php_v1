<?php
namespace content_site\body\blog\html;


class b2
{
	public static function html($_args, $_blogList)
	{

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id               = a($_args, 'id');
		$type             = a($_args, 'type');
		$title_position   = a($_args, 'magicbox_title_position');
		$link_color       = a($_args, 'link_color');

		$coverRatio       = a($_args, 'coverratio:class');
		$borderRadius     = a($_args, 'radius:class');
		$font_class       = a($_args, 'font:class');
		$effect           = a($_args, 'effect');

		$height           = a($_args, 'height:class');
		$gap              = a($_args, 'magicbox_gap:class');
		$background_style = a($_args, 'background:full_style');
		$color_heading    = a($_args, 'color_heading:full_style');
		$section_id       = a($_args, 'secition:id');
		$heading_class    = a($_args, 'heading:class');

		$maskImg          = a($_args, 'image_mask:class');


		$totalExist = count($_blogList);
		$totalCount = a($_args, 'count');

		$containerMaxWidth = 'max-w-screen-lg w-full px-2 sm:px-4 lg:px-4';
		if($totalCount > 3)
		{
			$containerMaxWidth = 'max-w-screen-xl w-full px-2 sm:px-4 lg:px-4';
		}

		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= "<div class='$containerMaxWidth m-auto'>";
			{
				$html .= \content_site\assemble\wrench\heading::simple1($_args);

				$grid_cols = 'relative grid grid-cols-12';
				if($gap)
				{
					$grid_cols .=	' '. $gap;
				}
				$html .= "<div class='$grid_cols'>";
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