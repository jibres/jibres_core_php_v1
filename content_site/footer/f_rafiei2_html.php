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
		$_args['background:full_style'] = 'style="background:#004bb0;"';


		$html = \content_site\assemble\wrench\section::element_start($_args, 'footer');
		{
			$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'text-sm']);
			{
				// primaray footer box
				$html .= '<div class="footerPrimary py-1 sm:py-5 md:py-10 lg:py-16 flex flex-wrap relative">';
				{
					// line1
					$html .= '<div class="w-full md:w-3/6 footerInfo relative z-10">';
					{
						$html .= '<div class="max-w-sm lg:max-w-md mx-auto md:mx-0">';
						{
							$html .= '<a href="'. \dash\url::kingdom() .'" class="block h-20 lg:h-24 max-w-md siteLogo rounded-lg overflow-hidden mb-6 transition hover:opacity-80 focus:opacity-80">';
							{
								$html .= '<img class="block grayscale w-full" src="'. \dash\sample\img::blank() .'" data-src="'. \dash\url::cdn(). '/enterprise/rafiei/header/rafiei-header-v1.png" alt="'. a($_args, 'heading'). '">';
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

				}
				$html .= '</div>';
					$html .= '<img class="h-80 max-w-md opacity-20 absolute" style="left:-50px;bottom:100px;" src="'. \dash\url::cdn(). '/enterprise/rafiei/logo/svg/logo-rafiei-oval-white-v1.svg" alt="'. a($_args, 'heading'). '">';
			}
			$html .= '</div>';

			// secondary footer box for links
			$menuOpt =
			[
				'nav_class' => 'py-2 md:py-4 lg:py-6',
				'ul_class'  => 'flex',
				'li_class'  => '',
				'a_class'   => 'block p-2 lg:px-4 rounded bg-gray-50 bg-opacity-0 hover:bg-opacity-20 focus:bg-opacity-30 text-white transition link-'. a($_args, 'link_color'),
			];

			$myMenuLine = \content_site\assemble\menu::generate(a($_args, 'menu_1'), $menuOpt);

			if($myMenuLine)
			{
				$html .= '<div class="select-none" style="background-color:#013C8A">';
				{
					$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'text-sm select-none', 'style' => 'background-color:#013C8A']);
					{
						$html .= $myMenuLine;
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}


			$html .= '<div class="select-none" style="background-color:#012350">';
			{
				$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'text-sm text-blue-100 flex py-8']);
				{
					$html .= '<p class="leading-relaxed flex-grow"'. $color_text. '>';
					$html .= a($_args, 'heading');
					$html .= '</p>';
					$html .= '<p dir="ltr" class="leading-relaxed"'. $color_text. '>';

					$html .= 'All Content by ';
					$html .= '<a href="'. \dash\url::kingdom(). '">';
					$html .=  ucwords(\dash\url::domain());
					$html .=  '</a>';
					$html .= ' is licensed under a ';
					$html .= '<a href="https://creativecommons.org/licenses/by/4.0/">';
					$html .= 'Creative Commons Attribution 4.0 International License';
					$html .=  '</a>';
					$html .= '.';
					$html .= '</p>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>