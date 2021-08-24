<?php
namespace content_site\body\heading\html;


class heading1
{

	public static function html($_args)
	{
		$html             = '';


		$id               = a($_args, 'id');
		$type             = a($_args, 'type');
		$height           = a($_args, 'height:class');
		$background_style = a($_args, 'background:full_style');
		$section_id       = a($_args, 'secition:id');
		$color_text       = a($_args, 'color_text:full_style');


		$classNames = $height;


		$html .= "<div data-type='$type' class='flex $classNames'$background_style $section_id>";
		{
			$html .= "<div class='m-auto'>";
			{
				$html .= '<div class="bg-gray-200 p-10 text-center rounded-3xl">';
				{

					$html .='<h1 class="text-5xl font-normal leading-normal mt-0 mb-2" '. $color_text.'>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h1>';

					$html .= '<div '.$color_text.'>';
					{
						$html .= a($_args, 'description');
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= "</div>";

		return $html;
	}


}
?>