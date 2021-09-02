<?php
namespace content_site\body\visitcard;


class visitcard1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				$borderRadius = a($_args, 'radius:class');
				$html .= '<div class="relative overflow-hidden bg-white shadow-xl hover:shadow-lg transition '. $borderRadius. '">';
				{

					$color_text       = a($_args, 'color_text:full_style');
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
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


	public static function html_old($_args)
	{
		$html             = '';


		$id               = a($_args, 'id');
		$type             = a($_args, 'model');
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