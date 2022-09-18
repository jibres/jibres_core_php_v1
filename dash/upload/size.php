<?php
namespace dash\upload;

/**
 * Class for size.
 */
class size
{

	public static function get()
	{
		$mb = 5;

		if(\dash\engine\store::inStore())
		{
			$mb = 1;

			if(\lib\store::detail('special_upload_provider'))
			{
				$mb = 100;
			}
			elseif(is_numeric(\lib\store::detail('uploadsize')))
			{
				$mb = floatval(\lib\store::detail('uploadsize'));
			}
			else
			{
				$allowedFileSize = \lib\app\plan\planCheck::get('allowedFileSize', 'size');

				if(is_numeric($allowedFileSize))
				{
					$mb = \dash\utility\convert::byte_to_mb($allowedFileSize);
				}

			}
		}

	 	// ini_set('post_max_size', ($mb + 1) . 'M');
	 	// ini_set('memory_limit', ($mb + 10). 'M');

		return self::MB($mb);
	}


	public static function set_default_file_size($_content = null)
	{
		$maxFileSize = self::get();
		$title       = self::readableSize($maxFileSize);
		\dash\data::maxFileSize($maxFileSize);
		\dash\data::maxFileSizeTitle($title);
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


	public static function readableSize($_filesize, $_forceEn = null)
	{
		if(is_numeric($_filesize))
		{
			$decr   = 1024;
			$step   = 0;
			$prefix = array(T_('Byte'), T_('KB'), T_('MB'), T_('GB'), T_('TB'), T_('PB'), 'EB', 'ZB', 'YB');
			if($_forceEn)
			{
				$prefix = array('Byte', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
			}

			while(($_filesize / $decr) > 0.9)
			{
				$_filesize = $_filesize / $decr;
				$step++;
			}

			if(isset($prefix[$step]))
			{
				if($_forceEn)
				{
					return \dash\fit::number_en(round($_filesize, 2)).' '.$prefix[$step];
				}

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
		$last  = \dash\str::mb_strtolower($last);

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
		if($allow_size > 0)
		{
			$check[]    = $allow_size;
		}

		$max_post   = self::sys_limit_size(ini_get('post_max_size'));
		if($max_post > 0)
		{
			$check[] = $max_post;
		}

		$memory_limit = self::sys_limit_size(ini_get('memory_limit'));

		if($memory_limit > 0)
		{
			$check[] = $memory_limit;
		}

		if($_max_size)
		{
			$check[] = $_max_size;
		}

		if(empty($check))
		{
			$check[] = (1024*1024*100); // 100 MB if not limit !!!
		}

		$min = min($check);

		return $min;
	}
}
?>