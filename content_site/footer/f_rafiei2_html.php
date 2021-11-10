<?php
namespace content_site\footer;


class f_rafiei2_html
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
		$color = '#004bb0';

		$color_heading    = a($_args, 'color_heading:full_style');
		$color_text       = a($_args, 'color_text:full_style');

		$hr = '<hr class="border-1 border-gray-600 my-1 opacity-30">';

		$html = \content_site\assemble\wrench\section::element_start($_args, 'footer');
		{
			$html .= \content_site\assemble\wrench\section::container($_args, 'text-sm');
			{
				// primaray footer box
				$html .= '<div class="footerPrimary py-1 sm:py-5 md:py-10 lg:py-16 flex flex-wrap">';
				{
					// line1
					$html .= '<div class="w-full lg:w-3/6 footerInfo">';
					{
						$html .= '<div class="max-w-sm lg:max-w-md md:mx-auto lg:mx-0">';
							$html .= '<a href="'. \dash\url::kingdom() .'" class="block h-20 lg:h-24 max-w-md siteLogo rounded-lg overflow-hidden mb-6 transition hover:opacity-80 focus:opacity-80">';
							{
								$html .= '<img class="block" src="'. \dash\url::cdn(). '/enterprise/rafiei/header/rafiei-header-v1.png" alt="'. a($_args, 'heading'). '">';
							}
							$html .= '</a>';

							if(a($_args, 'description'))
							{
								// desc
								$html .= '<div class="text-gray-200 line-clamp-5 leading-7 transition opacity-90 hover:opacity-100"'. $color_text. '>';
								{
									$html .= $_args['description'];
								}
								$html .= '</div>';
							}

						$html .= '</div>';
					}
					$html .= '</div>';


					$html .= '<div class="w-full lg:w-3/6 footerExtra">';
					{
						$html .= '<div class="SocialMedia mb-6 mx-auto">';
						{
							$html .= '<div class="text-2xl h-10 mb-2 text-white select-none text-center md:mt-4 lg:mt-0 footerExtra">';
							$html .= T_("Follow us on Social Media");
							$html .= '</div>';
							// socialNetwork
							$socialArg = ['navClass' => 'justify-center'];
							$html .= \content_site\assemble\wrench\socialnetworks::type2(\lib\store::social(), 10, $socialArg);

						}
						$html .= '</div>';


						$html .= '<div class="certificates flex justify-center mb-6 mx-auto">';
						{
							$certClass = 'inline-block w-24 h-24 rounded-lg bg-white p-1 transition opacity-70 hover:opacity-80 focus:opacity-100';
							if(a($_args, 'certificate_enamad') or 1)
							{
								// add enamad cert
								$html .= \content_site\assemble\cert::enamad($certClass. ' mx-2');
							}

							if(a($_args, 'certificate_samandehi') or 1)
							{
								// add samandehi cert
								$html .= \content_site\assemble\cert::samandehi($certClass);
							}
						}
						$html .= '</div>';
					}
					$html .= '</div>';
					$watermarkImg = 'left:-40px;bottom:-40px;';
					$html .= '<img class="h-80 max-w-md opacity-20 absolute" style="'. $watermarkImg. '" src="'. \dash\url::cdn(). '/enterprise/rafiei/logo/svg/logo-rafiei-oval-white-v1.svg" alt="'. a($_args, 'heading'). '">';
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

			$color = '#eda336';
			$topCircleStyle = 'height:40px;bottom:-30px;border-radius:50%;background-color:'. $color.';';
			$html .= '<div id="topLine" class="fixed w-full mx-auto right-0 left-0 z-50" style="'. $topCircleStyle. '"></div>';

		}
		$html .= '</footer>';

		return $html;
	}
}
?>