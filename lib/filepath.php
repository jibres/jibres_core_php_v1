<?php
namespace lib;


class filepath
{
	/**
	 * Make file domain address
	 * retrun dl.jibres
	 * or dl1.jibres
	 * or any subdomain for routing file
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function file_domain()
	{
		return \dash\url::site();

		$file_domain = '';
		$file_domain .= \dash\url::protocol(). '://dl.';
		$file_domain .= \dash\url::domain();
		return $file_domain;
	}


	/**
	 * Fix the path of file
	 *
	 * @param      <type>  $_path  The path
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function fix($_path)
	{
		if($_path && is_string($_path))
		{
			return self::file_domain(). '/'. $_path;
		}

		return $_path;
	}

}
?>