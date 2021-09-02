<?php
namespace content_site\body\headline;


class headline1_html
{

	public static function html($_args)
	{
		$color_text       = a($_args, 'color_text:full_style');

		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$style = 'style="background-image:url('. \dash\url::cdn(). '/img/sitebuilder/headline/headline1/mesh.png);background-repeat:repeat;background-attachment:fixed;"';

			$style = 'style="background-image:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3))"';

			$html .= '<div class="w-full h-screen absolute" '. $style. '></div>';

			$html .= '<div class="sm:max-w-xl p-5 md:p-10 lg:p-14 z-10">';
			{

				$html .='<h2 class="text-2xl sm:text-3xl md:text-4xl leading-normal sm:md:leading-normal md:leading-normal mb-2 sm:mb-4 md:mb-6" '. $color_text.'>';
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