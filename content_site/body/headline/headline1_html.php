<?php
namespace content_site\body\headline;


class headline1_html
{

	public static function html($_args)
	{
		$color_text    = a($_args, 'color_text:full_style');
		$color_heading = a($_args, 'color_heading:full_style');

		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\options\background\background_effect::html(a($_args, 'background_effect'));

			$html .= '<div class="sm:max-w-xl p-5 md:p-10 lg:p-14 z-10">';
			{

				$html .='<h2 class="text-2xl sm:text-3xl md:text-4xl leading-normal sm:md:leading-normal md:leading-normal mb-2 sm:mb-4 md:mb-6" '. $color_heading.'>';
				{
					$html .= a($_args, 'heading');
				}
				$html .= '</h2>';

				$html .= '<div class="text-sm sm:text-base" '.$color_text.'>';
				{
					$html .= a($_args, 'description');
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>