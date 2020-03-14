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
	public static function support_file_size($_pretty = false)
	{
		return self::MB(7, $_pretty);
	}


	public static function cms_file_size($_pretty = false)
	{
		return self::MB(10, $_pretty);
	}


	public static function crm_file_size($_pretty = false)
	{
		return self::MB(10, $_pretty);
	}


	// convert MB to byte
	public static function MB($_mb, $_pretty = false)
	{
		$mb   = floatval($_mb) * 1024 * 1024;
		$size = self::allow_size($mb);

		if(!$_pretty)
		{
			return round($size);
		}
		else
		{
			return self::readableSize($size);
		}
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


	public static function readableSize($_filesize)
	{
		if(is_numeric($_filesize))
		{
			$decr   = 1024;
			$step   = 0;
			$prefix = array(T_('Byte'), T_('KB'), T_('MB'), T_('GB'), T_('TB'), T_('PB'), 'EB', 'ZB', 'YB');

			while(($_filesize / $decr) > 0.9)
			{
				$_filesize = $_filesize / $decr;
				$step++;
			}

			if(isset($prefix[$step]))
			{
				return \dash\fit::number(round($_filesize, 2)).' '.$prefix[$step];
			}
			else
			{
				return '∞';
			}
		}

		return null;
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
		$check      = [];

		$allow_size = self::sys_limit_size(ini_get('upload_max_filesize'));
		$check[]    = $allow_size;

		$max_post   = self::sys_limit_size(ini_get('post_max_size'));
		if($max_post > 0)
		{
			$check[] = $max_post;
		}

		$memory_limit = self::sys_limit_size(ini_get('memory_limit'));
		$check[]      = $memory_limit;

		if($_max_size)
		{
			$check[] = $_max_size;
		}

		$min = min($check);

		return $min;
	}
}
?>