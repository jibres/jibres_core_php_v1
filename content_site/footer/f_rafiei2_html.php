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

		$html = \content_site\assemble\wrench\section::element_start($_args, 'footer');
		{
			$html .= \content_site\assemble\wrench\section::container($_args, 'text-sm');
			{
				// primaray footer box
				$html .= '<div class="footerPrimary py-1 sm:py-5 md:py-10 lg:py-16 flex flex-wrap">';
				{
					// line1
					$html .= '<div class="w-full md:w-3/6 footerInfo relative z-10">';
					{
						$html .= '<div class="max-w-sm lg:max-w-md mx-auto md:mx-0">';
						{
							$html .= '<a href="'. \dash\url::kingdom() .'" class="block h-20 lg:h-24 max-w-md siteLogo rounded-lg overflow-hidden mb-6 transition hover:opacity-80 focus:opacity-80" style1="filter:grayscale(1);">';
							{
								$html .= '<img class="block grayscale" src="'. \dash\url::cdn(). '/enterprise/rafiei/header/rafiei-header-v1.png" alt="'. a($_args, 'heading'). '">';
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
						}
						$html .= '</div>';
					}
					$html .= '</div>';
					// line1 end


					$html .= '<div class="w-full md:w-3/6 footerExtra relative z-10">';
					{
						$html .= '<div class="SocialMedia mb-6 mx-auto">';
						{
							$html .= '<div class="text-2xl h-10 mb-2 text-white select-none text-center md:mt-4 lg:mt-0">';
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
					}
					$html .= '</div>';

					$html .= '<img class="h-80 max-w-md opacity-20 absolute" style="left:-40px;bottom:-40px;" src="'. \dash\url::cdn(). '/enterprise/rafiei/logo/svg/logo-rafiei-oval-white-v1.svg" alt="'. a($_args, 'heading'). '">';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			// secondary footer box for links
			$html .= \content_site\assemble\wrench\section::container($_args, 'text-sm');
			{
				$menuOpt =
				[
					'nav_class' => '',
					'ul_class'  => '',
					'li_class'  => '',
					'a_class'   => 'inline-block p-1 sm:p-2 md:px-4 hover:opacity-70 focus:opacity-50 transition text-gray-100 link-'. a($_args, 'link_color'),
				];
				$menu1 = \content_site\assemble\menu::generate(a($_args, 'menu_1'), $menuOpt);

			}
			$html .= '</div>';


				if(a($_args, 'copyright'))
				{
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