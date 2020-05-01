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
				return \dash\url::cloud(). '/'. $_path;
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


	private static function extract_file($_url)
	{
		$thumb = $_url;
		if(!$thumb)
		{
			return null;
		}

		$thumb = self::fix($thumb);

		$file_addr = substr($thumb, 0, strrpos($thumb, '.'));
		$ext       = str_replace($file_addr, '', $thumb);
		$files =
		[
			'main'   => $thumb,
			'large'  => $file_addr. '-large'. $ext,
			'normal' => $file_addr. '-normal'. $ext,
			'thumb'  => $file_addr. '-thumb'. $ext,
		];

		return $files;
	}


	public static function thumb_image($_image_url)
	{
		$files = self::extract_file($_image_url);

		if(isset($files['thumb']))
		{
			return $files['thumb'];
		}

		return null;
	}


	public static function large_image($_image_url)
	{
		$files = self::extract_file($_image_url);

		if(isset($files['large']))
		{
			return $files['large'];
		}

		return null;
	}

	public static function normal_image($_image_url)
	{
		$files = self::extract_file($_image_url);

		if(isset($files['normal']))
		{
			return $files['normal'];
		}

		return null;
	}

}
?>