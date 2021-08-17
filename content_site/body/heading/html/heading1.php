<?php
namespace content_site\body\heading\html;


class heading1
{

	public static function html($_args)
	{
		$html             = '';

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id          = a($_args, 'id');
		$type        = a($_args, 'type');
		$coverRatio  = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		$font_class  = \content_site\assemble\font::class($_args);
		// $type        = 'b1';

		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background_style = \content_site\assemble\background::full_style($_args);
		$text_color       = \content_site\assemble\text_color::full_style($_args);
		$section_id       = \content_site\assemble\tools::section_id($type, $id);


		$classNames = $height;
		if($font_class)
		{
			$classNames .= ' '. $font_class;
		}

		$html .= "<div data-type='$type' class='flex $classNames'$background_style $section_id>";
		{
			$html .= "<div class='m-auto'>";
			{

				$html .= '<div class="m-auto">';
				{
					$html .='<h1 class="text-5xl font-normal leading-normal mt-0 mb-2 italic" '. $text_color.'>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h1>';
				}
				$html .= '</div>';

			}
			$html .= "</div>";
		}
		$html .= "</div>";

		return $html;
	}


}
?>