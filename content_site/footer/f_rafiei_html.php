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
		$html = \content_site\assemble\wrench\section::element_start($_args, 'footer');
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				$bgColor = a($_args, 'background_color');

				if(a($_args, 'background_pack') === 'solid' && $bgColor)
				{
					$fillColor = \content_site\assemble\color::rgb($bgColor);
					$html .= '<svg class="absolute right-0 left-0 top-0 z-10" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 100" xml:space="preserve"><path class="header_curve1" fill="rgba('. $fillColor. ',0.7)" d="M0,0v100C312.4,32.9,649.1,1.4,1000,1.4s687.6,31.4,1000,98.6V0H0z"/><path class="header_curve1" fill="rgba('. $fillColor. ',0.7)" d="M0,0v73.5C312.4,26.9,649.1,1.4,1000,1.4s687.6,25.4,1000,72V0H0z"/><path class="header_curve2" fill="rgba('. $fillColor. ',1)" d="M0,0v47C312.4,17.5,649.1,1.4,1000,1.4s687.6,16.1,1000,45.5V0H0z"/></svg>';
				}



				// action bar
				$html .= '<div class="top flex items-end py-1 sm:py-2 md:py-3">';
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
								$html .= '<h2 class="text-2xl font-bold text-white mb-2 line-clamp-1">';
								{
									$html .= $_args['heading'];
								}
								$html .= '</h2>';
							}

							if(a($_args, 'description'))
							{
								// desc
								$html .= '<div class="text-gray-300 line-clamp-3">';
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
					'a_class'   => 'inline-block p-1 sm:p-2 hover:opacity-70 focus:opacity-50 transition text-gray-100',
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

				$menuHTML = '<div class="grid grid-cols-'. $colCount. ' gap-3">';
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
					$html .= '<p class="text-gray-300 leading-relaxed py-8 opacity-60">';
					$html .= $_args['copyright'];
					$html .= '</p>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</footer>';

		return $html;
	}
}
?>