<?php
namespace content_site\header;


class h5_html
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
			$color = '#004bb0';
			$color = a($_args, 'background_color');
			$topBgStyle = 'background-image: url('. \dash\url::cdn() .'/enterprise/rafiei/v2/header-pattern-1.png);background-repeat:repeat-x;';
			$topBgStyle .= 'animation:bgMoveLtr 60s linear infinite;';


			$html .= '<div id="bgHeaderSymbol" class="absolute h-24 w-full mx-auto top-0 right-0 left-0 opacity-30" style="'. $topBgStyle. '"></div>';


			$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'select-none']);
			{
				$html .= '<div class="flex align-center h-20 rounded-lg relative py-2 px-4 overflow-hidden" style="background-color:'. $color. ';">';
				{
					$html .= '<a href="'. \dash\url::kingdom() .'" class="h-16 w-24 siteLogo rounded-lg overflow-hidden">';
					$html .= '<img class="block mx-auto h-full" src="'. \dash\url::cdn(). '/enterprise/rafiei/logo/svg/logo-rafiei-oval-white-v1.svg" alt="'. a($_args, 'heading'). '">';

					$html .= '<h1 class="hidden">'. a($_args, 'heading'). "</h1>";
					$html .= '</a>';

					$menuOpt =
					[
						'nav_class' => 'px-2 md:px-4 lg:px-6 text-sm justify-start',
						'ul_class'  => 'flex justify-center',
						'li_class'  => '',
						'a_class'   => 'block p-2 lg:px-4 rounded bg-gray-50 bg-opacity-0 hover:bg-opacity-20 focus:bg-opacity-30 text-white transition link-'. a($_args, 'link_color'),
					];
					$html .= \content_site\assemble\menu::generate(a($_args, 'menu_1'), $menuOpt);

					$html .= '<div class="flex-grow"></div>';
					// socialNetwork
					$html .= \content_site\assemble\wrench\socialnetworks::type2(\lib\store::social(), 8);
					// $symbolStyle = 'background-image: url('. \dash\url::cdn() .'/enterprise/rafiei/v2/symbol-1.svg);background-size:cover;';
					// $symbolStyle .= 'position:absolute;width:180px;height:150px;left:280px;top:-30px;';

					// $html .= '<div id="bgHeader" class="opacity-70" style="'. $symbolStyle. '"></div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			// $bgColor = a($_args, 'background_color');

			// if(a($_args, 'background_pack') === 'solid' && $bgColor)
			// {
			// 	$fillColor = \content_site\assemble\color::rgb($bgColor);
			// 	$html .= '<svg class="absolute right-0 left-0 z-10" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 100" xml:space="preserve"><path class="header_curve1" fill="rgba('. $fillColor. ',0.7)" d="M0,0v100C312.4,32.9,649.1,1.4,1000,1.4s687.6,31.4,1000,98.6V0H0z"/><path class="header_curve1" fill="rgba('. $fillColor. ',0.7)" d="M0,0v73.5C312.4,26.9,649.1,1.4,1000,1.4s687.6,25.4,1000,72V0H0z"/><path class="header_curve2" fill="rgba('. $fillColor. ',1)" d="M0,0v47C312.4,17.5,649.1,1.4,1000,1.4s687.6,16.1,1000,45.5V0H0z"/></svg>';
			// }

		}
		$html .= '</div>';

		return $html;
	}
}
?>