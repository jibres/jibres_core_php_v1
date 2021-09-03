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

		$style = 'background:url("'. \dash\url::cdn(). '/img/sitebuilder/footer/f3/footer3-bg.svg") right bottom no-repeat,linear-gradient(254.96deg, HSL(257, 32%, 11%) 0%, HSL(314, 33%, 18%) 99.41%);';
		$style = "style='". $style. "'";
		$html = '<footer id="jFooter3" class="relative py-10 mt-10" '. $style. '>';
		{
			$html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto">';
			{
				// action bar
				$html .= '<div class="top flex items-end p-1 sm:p-2 md:p-3">';
				{
					$html .= '<div class="flex-1">';
					{
						$siteTitle = \lib\store::title();
						$siteDesc = \lib\store::desc();
						$logo = \lib\store::logo();
						if($logo)
						{
							$html .= '<img class="inline-block w-32 h-32 rounded-lg bg-white" src="'. $logo. '" alt="'. $siteTitle. '">';
						}
						$html .= '<div class="inline-block px-2">';
						{
							// add title
							$html .= '<h2 class="text-2xl font-bold text-white">';
							{
								$html .= $siteTitle;
							}
							$html .= '</h2>';
							// desc
							$html .= '<div class="text-gray-300">';
							{
								$html .= $siteDesc;
							}
							$html .= '</div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

					$certClass = 'inline-block w-32 h-32 rounded-lg bg-white p-1';
					// add enamad cert
					$html .= \content_site\assemble\cert::enamad($certClass);
					// add samandehi cert
					$html .= \content_site\assemble\cert::samandehi($certClass);

				}
				$html .= '</div>';

				// menu bar
				$html .= '<div class="menuBar flex items-center bg-gray-50 rounded shadow-inner mt-2">';
				{
					if(a($_args, 'menu_1'))
					{
						$html .= '<nav class="flex-1 flex">';
						{
							$load_menu = \lib\app\menu\get::load_menu($_args['menu_1']);
							if(is_array(a($load_menu, 'list')))
							{
								foreach ($load_menu['list'] as $key => $value)
								{
									$target = a($value, 'target') ? 'target="_blank"' : null;

									$html .= "<a href='$value[url]' $target class='p-1 sm:p-2 md:p-3 bg-gray-200 bg-opacity-0 hover:bg-opacity-70 transition'>$value[title]</a>";
								}
							}
						}
						$html .= '</nav>';
					}
					else
					{
						$html .= '<div class="flex-1"></div>';
					}

					if(a($_args, 'menu_1'))
					{
						$html .= '<nav class="flex">';
						{
							$load_menu = \lib\app\menu\get::load_menu($_args['menu_1']);
							if(is_array(a($load_menu, 'list')))
							{
								foreach ($load_menu['list'] as $key => $value)
								{
									$target = a($value, 'target') ? 'target="_blank"' : null;

									$html .= "<a href='$value[url]' $target class='p-1 sm:p-2 md:p-3 bg-gray-200 bg-opacity-0 hover:bg-opacity-70 transition'>$value[title]</a>";
								}
							}
						}
						$html .= '</nav>';
					}
				}
				$html .= '</div>';

			}
			$html .= '</div>';

		}
		$html .= '</footer>';

		return $html;
	}
}
?>