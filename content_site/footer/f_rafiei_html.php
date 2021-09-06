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
		$html = '';
		// hr
		$hr = '<hr class="border-1 border-gray-600 my-5">';
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		$html .= $hr;
		// style
		$style = 'background:url("'. \dash\url::cdn(). '/img/sitebuilder/footer/f3/footer3-bg.svg") right bottom no-repeat,linear-gradient(254.96deg, HSL(257, 32%, 11%) 0%, HSL(314, 33%, 18%) 99.41%);';
		$style = "style='". $style. "'";

		$html .= '<footer id="jFooter3" class="relative py-5" '. $style. '>';
		{
			// $html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto">';
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
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