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

		$html .= share::announcement($_args);

		if(a($_args, 'heading') || a($_args, 'description') || a($_args, 'menu_1'))
		{
			$html .= '<div id="jHeader3" class="relative py-5">';
			{
				$html .= '<div class="max-w-screen-lg w-full px-2 sm:px-4 lg:px-5 m-auto justify-center text-center">';
				{
					if(a($_args, 'heading'))
					{
						$html .= '<a href="'.\dash\url::kingdom().'" class="">';
						{
							// add title
							$html .= '<h1 class="px-2 text-3xl font-bold">';
							{
								$html .= $_args['heading'];
							}
							$html .= '</h1>';
						}
						$html .= '</a>';
					}

					if(a($_args, 'description'))
					{
						$html .= '<h2 class="block px-2 mt-5 text-xl font-bold">';
						{
							$html .= $_args['description'];
						}
						$html .= '</h2>';
					}

					if(a($_args, 'menu_1'))
					{
						$html .= '<nav class="sm:ml-auto flex flex-wrap items-center  justify-center mt-10">';
						{
							$html .= \content_site\assemble\menu::generate($_args['menu_1'], 'border-b-2 border-t-2 mr-2 hover:text-gray-900');
						}
						$html .= '</nav>';
					}
				}
				$html .= '</div>';

			}
			$html .= '</div>';

		} // empty header

		return $html;
	}
}
?>
