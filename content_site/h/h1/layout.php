<?php
namespace content_site\h\h1;


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


		return $html;
	}
}
?>