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
			'allow_size' => \dash\upload\size::get(),
			'ext' =>
			[
				'jpg', 'jpeg', 'png'
			],
		];

		$file_detail = \dash\upload\file::upload($_upload_name, $meta);

		if(!$file_detail)
		{
			return false;
		}

		return $file_detail['path'];
	}


	public static function read_csv($_upload_name)
	{
		if(!$_upload_name)
		{
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'return_real_addr' => true,
			'ext' =>
			[
				'csv',
			],
		];

		$file = \dash\upload\file::upload($_upload_name, $meta);

		if(!$file)
		{
			return false;
		}


		$data = \dash\utility\import::csv($file);

		return $data;
	}



	public static function read_file($_upload_name)
	{
		if(!$_upload_name)
		{
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'return_real_addr' => true,
			'ext' =>
			[
				'csv', 'txt',
			],
		];

		$file = \dash\upload\file::upload($_upload_name, $meta);

		if(!$file)
		{
			return false;
		}

		$data = \dash\file::read($file);

		return $data;
	}
}
?>