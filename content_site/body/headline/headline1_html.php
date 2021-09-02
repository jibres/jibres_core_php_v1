<?php
namespace content_site\body\headline;


class headline1_html
{

	public static function html($_args)
	{
		$color_text       = a($_args, 'color_text:full_style');


		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			// $html .= \content_site\assemble\wrench\section::container_align_justify($_args);
			{
				$html .= '<div class="bg-gray-200 p-10 text-center rounded-3xl max-w-screen-sm">';
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
			// $html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>