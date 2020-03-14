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
		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'jpg', 'peg', 'png'
			],
		]

		$file_detail = \dash\upload\file::upload($_upload_name);

		if(!$file_detail)
		{
			return false;
		}

		return $file_detail['path'];
	}
}
?>