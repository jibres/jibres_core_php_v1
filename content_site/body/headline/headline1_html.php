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
				$html .= '<div class="sm:max-w-xl p-5 md:p-10 lg:p-14">';
				{

					$html .='<h2 class="text-2xl sm:text-3xl md:text-4xl leading-normal mb-6" '. $color_text.'>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h2>';

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