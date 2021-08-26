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
			$html .= '</div>';
		}
		$html .= '</header>';

		return $html;
	}
}
?>
