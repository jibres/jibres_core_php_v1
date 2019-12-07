<?php
namespace dash\upload;

/**
 * Class for size.
 */
class size
{

	/**
	 * Show the max file size to upload in support content
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function support_file_size()
	{
		$max_support_file_size = 50000;
		return self::allow_size($max_support_file_size);
	}


	public static function cms_file_size()
	{
		$max_cms_file_size = 100000;
		return self::allow_size($max_cms_file_size);
	}


	public static function crm_file_size()
	{
		$max_crm_file_size = 100000;
		return self::allow_size($max_crm_file_size);
	}



	/**
	 * is Ok Size
	 *
	 * @param      <type>  $_size  The size
	 */
	public static function ok($_size, $_meta)
	{
		$manual = null;
		if(isset($_meta['allow_size']) && is_numeric($_meta['allow_size']))
		{
			$manual = intval($_meta['allow_size']);
		}

		$allow_size = self::allow_size($manual);

		// not allow to upload fize by 0 byte size
		if(!intval($_size))
		{
			return false;
		}

		if(intval($_size) <= intval($allow_size))
		{
			return true;
		}

		return false;
	}



	/**
	 * Get system size
	 *
	 * @param      integer  $_size  The size
	 *
	 * @return     integer  ( description_of_the_return_value )
	 */
	private static function sys_limit_size($_size)
	{
		$_size = trim($_size);
		$last  = $_size[mb_strlen($_size)-1];
		$_size = (float) str_replace($last, '', $_size);
		$last  = mb_strtolower($last);

		switch($last)
		{
			case 'g':
				$_size *= 1024;
			case 'm':
				$_size *= 1024;
			case 'k':
				$_size *= 1024;
		}
		return $_size;
	}

	/**
	 * Get max file upload size
	 * @return [type] return in byte
	 */
	private static function allow_size($_max_size = null)
	{

		$allow_size   = self::sys_limit_size(ini_get('upload_max_filesize'));

		$max_post     = self::sys_limit_size(ini_get('post_max_size'));

		$memory_limit = self::sys_limit_size(ini_get('memory_limit'));

		if($_max_size)
		{
			$min = min($allow_size, $max_post, $memory_limit, $_max_size);
		}
		else
		{
			$min = min($allow_size, $max_post, $memory_limit);
		}

		return $min;
	}
}
?>