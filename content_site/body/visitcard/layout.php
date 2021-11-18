<?php
namespace content_site\body\visitcard;


class layout
{


	/**
	 * Layout visitcard html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$_args = \content_site\assemble\fire::store_detail($_args);
		$_args = \content_site\assemble\fire::store_social($_args);

		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args);
	}


}
?>