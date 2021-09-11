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

		$html .= '<header id="jHeaderRafiei2" class="relative py-2">';
		{
			// $html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto">';
			$html .= \content_site\assemble\wrench\section::container($_args, 'relative');
			{
				$color = '#eda336';
				$topCircleStyle = 'height:40px;top:-30px;border-radius:50%;background-color:'. $color.';';
				$html .= '<div id="topLine" class="fixed w-full mx-auto right-0 left-0 z-100" style="'. $topCircleStyle. '"></div>';

				$html .= '<a href="'. \dash\url::kingdom() .'" class="block max-w-md mx-auto my-2">';
				if(a($_args, 'logo'))
				{
					$html .= '<img class="block" src="'. a($_args, 'logo'). '" alt="'. a($_args, 'heading'). '">';
				}
				$html .= '</a>';

				$menuOpt =
				[
					'nav_class' => '',
					'ul_class'  => 'flex justify-center',
					'li_class'  => '',
					'a_class'   => 'block p-1 sm:p-2 md:p-3 rounded-lg bg-gray-100 bg-opacity-0 hover:bg-opacity-70 focus:bg-opacity-90 text-gray-800 transition',
				];
				$html .= \content_site\assemble\menu::generate(a($_args, 'menu_1'), $menuOpt);

			}
			$html .= '</div>';

		}
		$html .= '</header>';

		return $html;
	}
}
?>