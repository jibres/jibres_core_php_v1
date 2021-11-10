<?php
namespace content_site\footer;


class f_rafiei_html
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
		$color_heading    = a($_args, 'color_heading:full_style');
		$color_text       = a($_args, 'color_text:full_style');

		$hr = '<hr class="border-1 border-gray-600 my-1 opacity-30">';

		$html = \content_site\assemble\wrench\section::element_start($_args, 'footer');
		{
			$bgColor = a($_args, 'background_color');

			if(a($_args, 'background_pack') === 'solid' && $bgColor)
			{
				$html .= '<svg class="absolute right-0 left-0 bottom-full z-10" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 100" xml:space="preserve">';
				$html .= '<style type="text/css">.st0{opacity:0.7;fill:'.$bgColor. ';enable-background:new;}.st1{fill:'.$bgColor. ';}</style>';
				$html .= '<path class="st0" d="M2000,100V0c-312.4,67.2-649.1,98.6-1000,98.6S312.4,67.1,0,0v100H2000z"/>';
				$html .= '<path class="st0" d="M2000,100V26.6c-312.4,46.6-649.1,72-1000,72S312.4,73.1,0,26.5V100H2000z"/>';
				$html .= '<path class="st1" d="M2000,100V53.1c-312.4,29.4-649.1,45.5-1000,45.5S312.4,82.5,0,53v47H2000z"/>';
				$html .= '</svg>';
			}

			$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'text-sm']);
			{
				// action bar
				$html .= '<div class="top flex items-end py-1 pt-2 sm:py-5 md:pt-12 md:py-10">';
				{

					if(a($_args, 'logo'))
					{
						$html .= '<img class="inline-block w-32 h-32 rounded-lg bg-white" src="'. $_args['logo']. '" alt="'. a($_args, 'heading'). '">';
					}

					if(a($_args, 'description') || a($_args, 'heading'))
					{
						$html .= '<div class="flex-1 px-2">';
						{
							if(a($_args, 'heading'))
							{
								// add title
								$html .= '<h2 class="text-2xl font-bold text-white mb-2 line-clamp-1"'. $color_heading. '>';
								{
									$html .= $_args['heading'];
								}
								$html .= '</h2>';
							}

							if(a($_args, 'description'))
							{
								// desc
								$html .= '<div class="text-gray-300 line-clamp-3 leading-relaxed opacity-80"'. $color_text. '>';
								{
									$html .= $_args['description'];
								}
								$html .= '</div>';
							}
						}
						$html .= '</div>';
					}

					$certClass = 'inline-block w-32 h-32 rounded-lg bg-white p-1';

					if(a($_args, 'certificate_enamad'))
					{
						// add enamad cert
						$html .= \content_site\assemble\cert::enamad($certClass. ' mx-2');
					}

					if(a($_args, 'certificate_samandehi'))
					{
						// add samandehi cert
						$html .= \content_site\assemble\cert::samandehi($certClass);
					}

				}
				$html .= '</div>';


				$menuOpt =
				[
					'nav_class' => '',
					'ul_class'  => '',
					'li_class'  => '',
					'a_class'   => 'inline-block p-1 sm:p-2 md:px-4 hover:opacity-70 focus:opacity-50 transition text-gray-100 link-'. a($_args, 'link_color'),
				];
				$menu1 = \content_site\assemble\menu::generate(a($_args, 'menu_1'), $menuOpt);
				$menu2 = \content_site\assemble\menu::generate(a($_args, 'menu_2'), $menuOpt);
				$menu3 = \content_site\assemble\menu::generate(a($_args, 'menu_3'), $menuOpt);
				$menu4 = \content_site\assemble\menu::generate(a($_args, 'menu_4'), $menuOpt);

				$colCount = 0;
				if($menu1)
				{
					$colCount ++;
				}
				if($menu2)
				{
					$colCount ++;
				}
				if($menu3)
				{
					$colCount ++;
				}
				if($menu4)
				{
					$colCount ++;
				}

				$menuHTML = '<div class="grid grid-cols-'. $colCount. ' gap-3 py-4 md:py-10">';
				{
					$menuHTML .= $menu1;
					$menuHTML .= $menu2;
					$menuHTML .= $menu3;
					$menuHTML .= $menu4;
				}
				$menuHTML .= '</div>';

				if($colCount > 0)
				{
					$html .= $hr;
					$html .= $menuHTML;
				}


				if(a($_args, 'copyright'))
				{
					$html .= $hr;
					$html .= '<p class="leading-relaxed py-8 opacity-60"'. $color_text. '>';
					$html .= $_args['copyright'];
					$html .= '</p>';
				}
			}
			$html .= '</div>';

			$color = '#eda336';
			$topCircleStyle = 'height:40px;bottom:-30px;border-radius:50%;background-color:'. $color.';';
			$html .= '<div id="topLine" class="fixed w-full mx-auto right-0 left-0 z-50" style="'. $topCircleStyle. '"></div>';

		}
		$html .= '</footer>';

		return $html;
	}
}
?>