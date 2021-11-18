<?php
namespace content_site\body\application;


class layout
{


	/**
	 * Layout application html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

		$_args = \content_site\assemble\fire::store_detail($_args);

		$_args['android_apk_link'] = null;

		if(a($_args, 'show_android_apk_link'))
		{
			$_args['android_apk_link'] = \lib\store::android_apk_url();
		}


		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args);
	}


}
?>