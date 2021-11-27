<?php
namespace content_site\body\space;


class layout
{
	/**
	 * Layout space html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
	    {
	    	// free space !
	    }
	    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>