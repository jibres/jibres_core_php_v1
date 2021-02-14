<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class export
{

	public static function push_export_file($_tmpname, $_filename, $_type)
	{
		$meta =
		[
			'allow_size'        => filesize($_tmpname) + 1024, // allow size
			'upload_from_path'  => $_tmpname,
			'special_path_name' => 'export/'. $_type,
			'special_file_name' => $_filename,
			'special_file_ext' => 'csv',
			'upload_name'       => 'export',
			'ext'              =>
			[
				'csv',
			],
		];

		$file_detail = \dash\upload\file::upload(null, $meta);

		return $file_detail;
	}

}
?>