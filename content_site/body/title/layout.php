<?php
namespace content_site\body\title;


class layout
{


	/**
	 * Layout title html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args);
	}


}
?>