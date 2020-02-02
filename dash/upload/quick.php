<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class quick
{
	/**
	 * Upload a file
	 */
	public static function upload($_upload_name)
	{
		if(!$_upload_name)
		{
			return false;
		}

		$file_detail = \dash\upload\file::upload($_upload_name);

		if(!$file_detail)
		{
			return false;
		}

		return $file_detail['path'];
	}
}
?>