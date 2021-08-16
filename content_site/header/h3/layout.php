<?php
namespace content_site\header\h3;


class layout
{


	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$html = '';

		$html .= '<header class="text-gray-600 body-font">';
		{
			$html .= '<div class="container mx-auto flex flex-wrap p-5 flex-col sm:flex-row items-center">';
			{

				$html .= '<a class="flex title-font font-medium items-center text-gray-900 mb-4 sm:mb-0">';
				{

					$logo = \lib\pagebuilder::logo();

					if(!$logo)
					{
						$logo = \lib\store::logo();
					}

					if($logo)
					{
						$html .= '<img class="w-12 h-12 text-white p-2 bg-indigo-500 rounded-full" src="'. $logo. '" alt="'. a($_args, 'heading'). '">';
					}

					$html .= '<span class="ml-3 text-xl">'.a($_args, 'heading').'</span>';
				}
				$html .= '</a>';

				$html .= '<nav class="sm:ml-auto flex flex-wrap items-center text-base justify-center">';
				{
					$html .= '<a class="mr-5 hover:text-gray-900">First Link</a>';
					$html .= '<a class="mr-5 hover:text-gray-900">Second Link</a>';
					$html .= '<a class="mr-5 hover:text-gray-900">Third Link</a>';
					$html .= '<a class="mr-5 hover:text-gray-900">Fourth Link</a>';
				}
				$html .= '</nav>';

				$html .= '<button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 sm:mt-0">Login</button>';
			}
			$html .= '</div>';
		}
		$html .= '</header>';




			// if(\lib\pagebuilder::have_header_menu())
			// {
			// 	$html .= '<div class="menuBar row">';
			// 	{
			// 		$html .= '<div class="c">'. \lib\pagebuilder::menu('header_menu_1'). '</div>';
			// 		$html .= '<div class="c-auto os">'. \lib\pagebuilder::menu('header_menu_2', 'xs0'). '</div>';
			// 	}
			// 	$html .= '</div>';
			// }



		return $html;
	}
}
?>
