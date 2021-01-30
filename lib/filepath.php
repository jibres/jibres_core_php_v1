<?php
namespace lib;


class filepath
{
	/**
	 * Fix the path of file
	 *
	 * @param      <type>  $_path  The path
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function fix($_path, $_option = [])
	{
		$new_path = null;
		if($_path && is_string($_path))
		{
			if(substr($_path, 0, 7) === 'http://' || substr($_path, 0, 8) === 'https://' )
			{
				$new_path = $_path;
			}
			else
			{
				if(isset($_option['avatar']) && $_option['avatar'])
				{
					if(preg_match("/^\w{5}\/\d{6}\/.*/", $_path))
					{
						return self::fix($_path, ['force_cloud' => true]);
					}
					else
					{
						return self::fix($_path, ['force_dl' => true]);
					}
				}

				if(\dash\engine\store::inStore() || (isset($_option['force_cloud']) && $_option['force_cloud']))
				{
					$new_path = \dash\url::cloud(). '/'. $_path;
				}
				elseif(!\dash\engine\store::inStore() || (isset($_option['force_dl']) && $_option['force_dl']))
				{
					$new_path = \dash\url::dl(). '/'. $_path;
				}
				else
				{
					// never !
					$new_path = $_path;
				}
			}
		}
		else
		{
			$new_path = $_path;
		}

		return $new_path;
	}


	public static function fix_avatar($_path)
	{
		return self::fix($_path, ['avatar' => true]);
	}


	// in jibres need to load file from cloud (force)
	public static function force_cloud($_path)
	{
		return self::fix($_path, ['force_cloud' => true]);
	}


	// in jibres need to load file from dl (force)
	public static function force_dl($_path)
	{
		return self::fix($_path, ['force_dl' => true]);
	}


	/**
	 * Remove the host from file
	 * in some place we have the full address file and need to remove host to save in database
	 *
	 * @param      <type>  $_addr  The address
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function raw_path($_addr)
	{
		$addr = str_replace(\dash\url::cloud(). '/', '', $_addr);
		$addr = str_replace(\dash\url::dl(). '/', '', $addr);
		return $addr;
	}


	/**
	 * Get file paht and return real address
	 *
	 * @param      <type>  $_addr  The address
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function fix_real_path($_addr)
	{
		if(!is_string($_addr))
		{
			return null;
		}

		$addr = null;

		if(\dash\engine\store::inStore())
		{
			$addr = YARD. 'talambar_cloud/'. $_addr;
		}
		else
		{
			$addr = YARD. 'talambar_dl/'. $_addr;
		}

		return $addr;
	}


}
?>