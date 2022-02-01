<?php
namespace content_site\body\formbuilder;


class layout
{
	/**
	 * Layout formbuilder html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
	    {
			if(a($_args, 'formbuilder') && is_numeric($_args['formbuilder']))
			{

				$addon = \dash\csrf::html();
				$addon .= \dash\captcha\recaptcha::html();
				$addon .= '<input type="hidden" name="notredirect" value="1">';

				$html .= \lib\app\form\generator::full_html($_args['formbuilder'], $addon);
			}
	    	// free formbuilder !
	    }
	    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>