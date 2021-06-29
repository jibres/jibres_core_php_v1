<?php
namespace content_site\h\h2;


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

		$html .= '<h1 class="">';
		{
			$html .= a($_args, 'heading');
		}
		$html .= '</h1>';
		$html .= '<img src="'.\lib\filepath::fix(a($_args, 'file')).'">';

		return $html;
	}
}
?>