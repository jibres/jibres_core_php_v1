<?php
namespace content_site\header;


class h1_html
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

		$html .= '<header id="jHeader3" class="relative py-5">';
		{
			$html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto justify-center text-center">';
			{

				$html .= '<a href="" class="">';
				{
					$siteTitle = \lib\store::title();
					// add title
					$html .= '<h1 class="px-2 text-3xl font-bold">';
					{
						$html .= $siteTitle;
					}
					$html .= '</h1>';
				}
				$html .= '</a>';

				$html .= '<h2 class="block px-2 mt-5 text-xl font-bold">';
				{
					$html .= \lib\store::desc();
				}
				$html .= '</h2>';

				if(a($_args, 'menu_1'))
				{
					$html .= '<nav class="sm:ml-auto flex flex-wrap items-center  justify-center mt-10">';
					{
						$load_menu = \lib\app\menu\get::load_menu($_args['menu_1']);
						if(is_array(a($load_menu, 'list')))
						{
							foreach ($load_menu['list'] as $key => $value)
							{
								$target = a($value, 'target') ? 'target="_blank"' : null;

								$html .= "<a href='$value[url]' $target class='mr-2 border-t-2 border-b-2 hover:text-gray-900'>$value[title]</a>";
							}
						}
					}
					$html .= '</nav>';
				}
			}
			$html .= '</div>';

		}
		$html .= '</header>';

		return $html;
	}
}
?>
