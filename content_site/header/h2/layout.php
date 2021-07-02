<?php
namespace content_site\header\h2;


class layout
{


	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$html = '';

		$html .= '<div class="jHeader1">';
		{
			$html .= '<h1>';
			{
				$html .= '<a href="'. \dash\url::kingdom(). '">'.a($_args, 'heading').'</a>';
			}
			$html .= '</h1>';

			$html .= '<h2>';
			{
				$html .= a($_args, 'description');

			}
			$html .= '</h2>';

			$html .= \lib\pagebuilder::menu('header_menu_1');

		}
		$html .= '</div>';


		return $html;
	}
}
?>
