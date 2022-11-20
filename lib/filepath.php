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
				$new_path = self::fixArvandFailedDomain($_path);
			}
			else
			{
				if(isset($_option['avatar']) && $_option['avatar'])
				{
					if(preg_match("/^(local\/)?\w{5}\/\d{6}\/.*/", $_path))
					{
						return self::fix($_path, ['force_cloud' => true]);
					}
					else
					{
						return self::fix($_path, ['force_dl' => true]);
					}
				}

				$new_path = '';
				if(isset($_option['force_cloud']) && $_option['force_cloud'])
				{
					$new_path = \dash\url::cloud(). '/';
				}
				elseif(isset($_option['force_dl']) && $_option['force_dl'])
				{
					$new_path = \dash\url::dl(). '/';
				}
				else
				{
					if(\dash\engine\store::inStore())
					{
						$new_path = \dash\url::cloud(). '/';
					}
					else
					{
						$new_path = \dash\url::dl(). '/';
					}
				}

				$new_path .= $_path;
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


	public static function get_detail($_path)
	{
		$result =
		[
			'ext' => null,
			'type' => null,
			'mime' => null,
		];

		if(is_string($_path) && $_path)
		{
			$ext = substr(strrchr($_path, '.'), 1);
			$result['ext'] = $ext;


			$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
			if(isset($mime_detail['type']))
			{
				$result['type'] = $mime_detail['type'];
			}

			if(isset($mime_detail['mime']))
			{
				$result['mime'] = $mime_detail['mime'];
			}
		}

		return $result;
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


	private static function fixArvandFailedDomain(string $_path)
	{
		if(strpos($_path, 'arvanstorage.com') !== false)
		{
			return str_replace('arvanstorage.com', 'arvanstorage.ir', $_path);
		}

		return $_path;
	}


}
?>