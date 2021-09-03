<?php
namespace content_site\footer;


class f1_html
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

		if(a($_args, 'heading') || a($_args, 'copyright'))
		{
			$html .= '<footer class="text-gray-600 body-font text-center shadow-inner">';
			{
				$html .= '<div class="container px-5 py-5 mx-auto text-center">';
				{
					if(a($_args, 'heading'))
					{
						$html .= '<a href="'.\dash\url::kingdom().'" class="title-font font-medium items-center md:justify-start justify-center text-gray-900 block">';
						{
							$html .= '<span class="ml-3 text-xl">';
							{
								$html .= $_args['heading'];
							}
							$html .= '</span>';
						}
						$html .= '</a>';
					}

					if(a($_args, 'copyright'))
					{
						$html .= '<a href="'.\dash\url::kingdom().'" class="title-font font-medium items-center md:justify-start justify-center text-gray-900 block">';
						{
							$html .= '<span class="ml-3 text-xl">';
							{
								$html .= $_args['copyright'];
							}
							$html .= '</span>';
						}
						$html .= '</a>';
					}
				}
				$html .= '</div>';
			}
			$html .= '</footer>';
		}

		return $html;
	}
}
?>