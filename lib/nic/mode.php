<?php
namespace lib\nic;


class mode
{
	/**
	 * Enable api mode or disable
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function api()
	{
		// in server needless to run api
		if(!\dash\url::isLocal())
		{
			return false;
		}


		// only in local mode can set this configure

		return true; // everything fetch from api



		return false; // api is disable

	}
}
?>