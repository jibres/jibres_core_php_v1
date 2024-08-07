<?php
namespace content_site\header;


class h3_html
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

		$html .= '<div id="jHeader3" class="relative py-5">';
		{
			// $html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto">';
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				if(a($_args, 'logo') || a($_args, 'heading') || a($_args, 'link_search') || a($_args, 'link_cart') || a($_args, 'link_enter'))
				{
					// action bar
					$html .= '<div class="actionBar flex items-center p-1 sm:p-2 md:p-3 bg-gray-50 rounded shadow-inner">';
					{
						$html .= '<a href="'. \dash\url::kingdom() .'" class="flex-1 flex items-center">';
						{
							$logo = a($_args, 'logo');

							if($logo)
							{
								$html .= '<img class="inline-block w-16 h-16 rounded" src="'. $logo. '" alt="'. a($_args, 'heading'). '">';
							}

							if(a($_args, 'heading'))
							{
								// add title
								$html .= '<h1 class="inline-block px-2 text-2xl font-bold">';
								{
									$html .= $_args['heading'];
								}
								$html .= '</h1>';
							}
						}
						$html .= '</a>';


						if(a($_args, 'link_search'))
						{
							$html .= '<a class="h-12 w-12 p-3 mx-1 bg-gray-50 rounded-full relative transition hover:shadow-sm" href="'. \dash\url::kingdom(). '/search">';
							{
								$html .= \dash\utility\icon::svg('search');
							}
							$html .= '</a>';
						}

						if(a($_args, 'link_cart'))
						{
							$html .= '<a class="h-12 w-12 p-3 mx-1 bg-gray-50 rounded-full relative transition hover:shadow-sm" href="'. \dash\url::kingdom(). '/cart">';
							{
								$html .= \dash\utility\icon::svg('cart');
								$html .= '<span class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 text-center leading-5 p-0.5 text-sm">';
								$html .= \dash\fit::number(a($_args, 'cart_count'));
								$html .= '</span>';
							}
							$html .= '</a>';
						}

						if(a($_args, 'link_enter'))
						{
							$enterTxt  = T_("Enter to account");
							$enterLink = \dash\url::kingdom(). '/enter';
							if(\dash\user::login())
							{
								$enterTxt  = T_("Profile");
								$enterLink = \dash\url::kingdom(). '/profile';
							}
							$html .= '<a class="p-3 mx-1 rounded link-secondary" href="'. $enterLink. '">';
							{
								$html .= $enterTxt;
							}
							$html .= '</a>';
						}

					}
					$html .= '</div>';

				} // empty header

				if(a($_args, 'menu_1') || a($_args, 'menu_2'))
				{
					// menu bar
					$html .= '<div class="menuBar flex items-center bg-gray-50 rounded shadow-inner mt-2">';
					{
						$menuOpt =
						[
							'nav_class' => '',
							'ul_class'  => 'flex',
							'li_class'  => '',
							'a_class'   => 'block p-1 sm:p-2 md:p-3 bg-gray-200 bg-opacity-0 hover:bg-opacity-70 transition',
						];

						$menuOptPrimary                   = $menuOpt;
						$menuOptPrimary['nav_class']      = 'flex-1';
						$menuOptPrimary['force_show_box'] = true;
						$html .= \content_site\assemble\menu::generate(a($_args, 'menu_1'), $menuOptPrimary);

						$html .= \content_site\assemble\menu::generate(a($_args, 'menu_2'), $menuOpt);
					}
					$html .= '</div>';
				}

			}
			$html .= '</div>';

		}
		$html .= '</div>';

		return $html;
	}
}
?>