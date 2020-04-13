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
		// only in local mode can set this configure
		// in server needless to run api
		if(!\dash\url::isLocal())
		{
			return false;
		}

		if(gethostname() === 'reza-jibres')
		{
			return false;
		}

		return true; // everything fetch from api

		return false; // api is disable

	}
}
?>