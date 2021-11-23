<?php
namespace content_site\body\twitter;


class layout
{


	/**
	 * Layout twitter html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

		// $blog = \lib\app\twitter\business::get_my_posts();


		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args, $blog);
	}


}
?>