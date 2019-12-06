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
	public static function ok($_upload_name)
	{
		switch (\dash\request::files($_upload_name, 'error'))
		{
			case UPLOAD_ERR_OK:
				break;

			case UPLOAD_ERR_NO_FILE:
				\dash\notif::error(T_('No file sent'));
				return false;

			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				\dash\notif::error(T_('Exceeded filesize limit'));
				return false;

			default:
				\dash\notif::error(T_('Unknown errors'));
				return false;
		}

		$fileInfo           = pathinfo(\dash\request::files($_upload_name, 'name'));

		if(isset($fileInfo['filename']))
		{
			$fileName     = $fileInfo['filename'];
		}
		if(isset($fileInfo['extension']))
		{
			$fileExt      = mb_strtolower($fileInfo['extension']);

			if(mb_strtolower($fileExt) === 'jpeg')
			{
				$fileExt = 'jpg';
			}
		}

		$extCheck           = \dash\upload\extensions::check($fileExt);

		$fileType     = isset($extCheck['type']) ? $extCheck['type'] : null;
		$fileMime     = isset($extCheck['mime']) ? $extCheck['mime'] : null;
		$fileDisallow = isset($extCheck['disallow']) ? $extCheck['disallow'] : null;

		if(!$fileMime)
		{
			\dash\notif::error(T_("We can not support this file type"));
			return false;
		}


		$fileSize = \dash\request::files($_upload_name, 'size');

		//check file extention with allowed extention list
		// set file data like name, ext, mime
		// file with long name does not allowed in our system
		if(mb_strlen($fileName) > 200 || strpos($fileName, 'htaccess') !== false)
		{
			\dash\notif::error(T_('Exceeded file name limit'));
			return false;
		}

		// file with long extension does not allowed in our system
		if(mb_strlen($fileExt) > 10 || $fileDisallow )
		{
			\dash\notif::error(T_('Exceeded file extension limit'));
			return false;
		}


		$fileMd5      = md5_file(\dash\request::files($_upload_name, 'tmp_name'));


		$result =
		[
			'name' => $fileName,
			'ext'  => $fileExt,
			'type' => $fileType,
			'mime' => $fileMime,
			'size' => $fileSize,
			'md5'  => $fileMd5,
		];

		return $result;
	}
}
?>