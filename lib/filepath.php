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

		if(\dash\engine\store::inStore())
		{
			return \dash\url::cloud();
		}
		else
		{
			return \dash\url::dl();
		}
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
			if(substr($_path, 0, 7) === 'http://' || substr($_path, 0, 8) === 'https://' )
			{
				// no change
			}
			else
			{
				return self::file_domain(). '/'. $_path;
			}
		}

		return $_path;
	}


	// in jibres need to load file from cloud (force)
	public static function force_cloud($_path)
	{
		if($_path && is_string($_path))
		{
			if(substr($_path, 0, 7) === 'http://' || substr($_path, 0, 8) === 'https://' )
			{
				// no change
			}
			else
			{
				if(substr($_path, 0, 2) === '1/')
				{
					return \dash\url::dl(). '/'. $_path;
				}
				else
				{
					return \dash\url::cloud(). '/'. $_path;
				}
			}
		}

		return $_path;
	}


	// in jibres need to load file from dl (force)
	public static function force_dl($_path)
	{
		if($_path && is_string($_path))
		{
			if(substr($_path, 0, 7) === 'http://' || substr($_path, 0, 8) === 'https://' )
			{
				// no change
			}
			else
			{
				return \dash\url::dl(). '/'. $_path;
			}
		}

		return $_path;
	}

}
?>