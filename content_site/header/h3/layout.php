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


		$html .= '<header id="jHeader3" class="relative py-5 bg-gray-100">';
		{
			$html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto">';
			{
				$html .= '<div class="actionBar flex p-1 sm:p-2 md:p-3 bg-white rounded shadow-sm">';
				{
					$html .= '<a href="" class="">';
					{
						$siteTitle = \lib\store::title();
						$logo = \lib\store::logo();
						if($logo)
						{
							$html .= '<img class="w-16 h-16 rounded" src="'. $logo. '" alt="'. $siteTitle. '">';
						}
						// add title
						$html .= '<h1 class="text-2xl">';
						{
							$html .= $siteTitle;
						}
						$html .= '</h1>';
					}
					$html .= '</a>';


				}
				$html .= '</div>';
			}
			$html .= '</div>';




			// $html .= '<div class="container mx-auto flex flex-wrap p-5 flex-col sm:flex-row items-center">';
			{
				$html .= '<a class="flex title-font font-medium items-center text-gray-900 mb-4 sm:mb-0">';
				{
					$logo = null;

					if(a($_args, 'use_as_logo') === 'business_logo')
					{
						$logo = \lib\store::logo();
					}
					elseif(a($_args, 'use_as_logo') === 'custom_logo')
					{
						$logo = a($_args, 'header_logo');
						if($logo)
						{
							$logo = \lib\filepath::fix($logo);
						}
					}

					if($logo)
					{
						$html .= '<img class="w-12 h-12 text-white p-2 bg-indigo-500 rounded-full" src="'. $logo. '" alt="'. a($_args, 'heading'). '">';
					}

					if(a($_args, 'heading'))
					{
						$html .= '<span class="ml-3 text-xl">'.a($_args, 'heading').'</span>';
					}
				}
				$html .= '</a>';

				if(a($_args, 'menu_1'))
				{
					$html .= '<nav class="sm:ml-auto flex flex-wrap items-center text-base justify-center">';
					{
						$load_menu = \lib\app\menu\get::load_menu($_args['menu_1']);
						if(is_array(a($load_menu, 'list')))
						{
							foreach ($load_menu['list'] as $key => $value)
							{
								$target = a($value, 'target') ? 'target="_blank"' : null;

								$html .= "<a href='$value[url]' $target class='mr-5 hover:text-gray-900'>$value[title]</a>";
							}
						}
					}
					$html .= '</nav>';
				}

				$html .= '<button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 sm:mt-0">Login</button>';
			}
			// $html .= '</div>';
		}
		$html .= '</header>';

		return $html;
	}
}
?>
