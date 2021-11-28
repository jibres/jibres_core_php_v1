<?php
namespace content_site\header;


class h_rafiei_html
{
	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function html($_args)
	{
		$html = '';

		$html .= share::announcement($_args);

		$html = \content_site\assemble\wrench\section::element_start($_args, 'header');
		{
			$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'relative py-2']);
			{
				$color = '#eda336';
				$topCircleStyle = 'height:40px;top:-30px;border-radius:50%;background-color:'. $color.';';
				$html .= '<div id="topLine" class="fixed w-full mx-auto right-0 left-0 z-50" style="'. $topCircleStyle. '"></div>';

				$html .= '<a href="'. \dash\url::kingdom() .'" class="block max-w-md mx-auto py-1 md:py-3">';
				if(a($_args, 'logo'))
				{
					$html .= '<img class="block mx-auto max-h-48 rounded" src="'. a($_args, 'logo'). '" alt="'. a($_args, 'heading'). '">';
				}
				$html .= '</a>';

				$menuOpt =
				[
					'nav_class' => 'py-2',
					'ul_class'  => 'flex justify-center',
					'li_class'  => '',
					'a_class'   => 'block p-1 sm:p-2 md:px-4 rounded-lg bg-gray-100 bg-opacity-0 hover:bg-opacity-20 focus:bg-opacity-50 text-gray-800 transition link-'. a($_args, 'link_color'),
				];
				$html .= \content_site\assemble\menu::generate(a($_args, 'menu_1'), $menuOpt);
			}
			$html .= '</div>';

			$bgColor = a($_args, 'background_color');

			if(a($_args, 'background_pack') === 'solid' && $bgColor)
			{
				$fillColor = \content_site\assemble\color::rgb($bgColor);
				$html .= '<svg class="absolute right-0 left-0 z-10" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 100" xml:space="preserve"><path class="header_curve1" fill="rgba('. $fillColor. ',0.7)" d="M0,0v100C312.4,32.9,649.1,1.4,1000,1.4s687.6,31.4,1000,98.6V0H0z"/><path class="header_curve1" fill="rgba('. $fillColor. ',0.7)" d="M0,0v73.5C312.4,26.9,649.1,1.4,1000,1.4s687.6,25.4,1000,72V0H0z"/><path class="header_curve2" fill="rgba('. $fillColor. ',1)" d="M0,0v47C312.4,17.5,649.1,1.4,1000,1.4s687.6,16.1,1000,45.5V0H0z"/></svg>';
			}

		}
		$html .= '</div>';

		return $html;
	}
}
?>