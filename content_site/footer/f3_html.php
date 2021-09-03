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
					$siteTitle = \lib\store::title();
					$siteDesc = \lib\store::desc();
					$logo = \lib\store::logo();

					if($logo)
					{
						$html .= '<img class="inline-block w-32 h-32 rounded-lg bg-white" src="'. $logo. '" alt="'. $siteTitle. '">';
					}
					$html .= '<div class="flex-1 px-2">';
					{
						// add title
						$html .= '<h2 class="text-2xl font-bold text-white mb-2 line-clamp-1">';
						{
							$html .= $siteTitle;
						}
						$html .= '</h2>';
						// desc
						$html .= '<div class="text-gray-300 line-clamp-3">';
						{
							$html .= $siteDesc;
						}
						$html .= '</div>';
					}
					$html .= '</div>';

					$certClass = 'inline-block w-32 h-32 rounded-lg bg-white p-1';
					// add enamad cert
					$html .= \content_site\assemble\cert::enamad($certClass. 'mx-2');
					// add samandehi cert
					$html .= \content_site\assemble\cert::samandehi($certClass);

				}
				$html .= '</div>';
				$html .= $hr;





				$html .= $hr;
				$html .= '<p class="text-gray-300 leading-relaxed py-8 opacity-60">';
				$html .= 'All right reserved.';
				$html .= '</p>';
			}
			$html .= '</div>';
		}
		$html .= '</footer>';

		return $html;
	}
}
?>