<?php
namespace dash\upload;

/**
 * Class for validation file.
 */
class validation_file
{


	/**
	 * Check is ok $_FILE
	 *
	 * @param      <type>   $_upload_name  The upload name
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function ok($_upload_name, $_meta = [])
	{
		switch (\dash\upload\file::my_files($_upload_name, 'error'))
		{
			case UPLOAD_ERR_OK:
				// no error
				break;

			case UPLOAD_ERR_NO_FILE:
				\dash\notif::error(T_('No file sent'));
				return false;
				break;

			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				\dash\notif::error(T_('Exceeded filesize limit'));
				return false;
				break;

			default:
				\dash\notif::error(T_('Unknown errors'));
				return false;
		}

		$fileName = null;

		$tmp_name = \dash\upload\file::my_files($_upload_name, 'tmp_name');

		$fileInfo           = pathinfo(\dash\upload\file::my_files($_upload_name, 'name'));

		if(isset($fileInfo['filename']))
		{
			$fileName     = $fileInfo['filename'];
		}

		$fileExt = null;
		if(isset($fileInfo['extension']))
		{
			$fileExt      = mb_strtolower($fileInfo['extension']);

			if($fileExt === 'jpeg')
			{
				$fileExt = 'jpg';
			}
		}

		// force convert jpeg to png

		if($fileExt !== 'png' && isset($_meta['force_png']) && $tmp_name)
		{
			imagepng(imagecreatefromstring(file_get_contents($tmp_name)), $tmp_name);
			$fileExt = 'png';
		}

		$extCheck           = \dash\upload\extentions::check($tmp_name, $fileExt, $_meta);

		if(!\dash\engine\process::status())
		{
			return false;
		}

		$fileType  = isset($extCheck['type'])  ? $extCheck['type']  : null;
		$fileMime  = isset($extCheck['mime'])  ? $extCheck['mime']  : null;
		$fileAllow = isset($extCheck['allow']) ? $extCheck['allow'] : false;

		if(!$fileMime)
		{
			\dash\notif::error(T_("We not support this file type"));
			return false;
		}

		$fileSize = \dash\upload\file::my_files($_upload_name, 'size');

		//check file extention with allowed extention list
		// set file data like name, ext, mime
		// file with long name does not allowed in our system
		if(mb_strlen($fileName) > 200 || strpos($fileName, 'htaccess') !== false)
		{
			\dash\notif::error(T_('Exceeded file name limit'));
			return false;
		}

		$fileName = \dash\validate::string_200($fileName);

		// file with long extension does not allowed in our system
		if(mb_strlen($fileExt) > 10 || $fileAllow === false )
		{
			if(isset($_meta['notif_msg_ext']))
			{
				\dash\notif::error($_meta['notif_msg_ext']);
			}
			else
			{
				\dash\notif::error(T_('Can not upload this file because the extension of file is not allowed'));
			}
			return false;
		}


		$fileMd5      = md5_file($tmp_name);

		$result =
		[
			'filename' => \dash\validate::string_200($fileName, false),
			'ext'      => \dash\validate::string_200($fileExt, false),
			'type'     => \dash\validate::string_200($fileType, false),
			'mime'     => \dash\validate::string_200($fileMime, false),
			'size'     => \dash\validate::int($fileSize, false),
			'md5'      => $fileMd5,
			'tmp_name' => $tmp_name,
		];

		return $result;
	}
}
?>