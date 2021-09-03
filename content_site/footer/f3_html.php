<?php
namespace content_site\footer;


class f3_html
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
		// hr
		$hr = '<hr class="border-1 border-gray-600 my-5">';
		// style
		$style = 'background:url("'. \dash\url::cdn(). '/img/sitebuilder/footer/f3/footer3-bg.svg") right bottom no-repeat,linear-gradient(254.96deg, HSL(257, 32%, 11%) 0%, HSL(314, 33%, 18%) 99.41%);';
		$style = "style='". $style. "'";

		$html = '<footer id="jFooter3" class="relative py-5" '. $style. '>';
		{
			$html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto">';
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
				$html .= $hr;




				$html .= $hr;

				if(a($_args, 'description_footer'))
				{
					$html .= '<p class="text-gray-300 leading-relaxed py-8 opacity-60">';
					$html .= $_args['description_footer'];
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