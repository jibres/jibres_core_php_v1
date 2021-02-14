<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class importexport
{

	public static function push_export_file($_tmpname, $_filename, $_type)
	{
		$meta =
		[
			'allow_size'        => filesize($_tmpname) + 1024, // allow size
			'upload_from_path'  => $_tmpname,
			'special_path_name' => 'export/'. $_type,
			'special_file_name' => $_filename,
			'special_file_ext'  => 'csv',
			'upload_name'       => 'export',
			'ext'               =>
			[
				'csv',
			],
		];

		$file_detail = \dash\upload\file::upload(null, $meta);

		return $file_detail;
	}



	public static function push_import_file($_upload_name, $_filename, $_type)
	{
		$meta =
		[
			'allow_size'        => \dash\upload\size::get(),
			'special_path_name' => 'import/'. $_type,
			'special_file_name' => $_filename,
			'special_file_ext'  => 'csv',
			'ext'               =>
			[
				'csv',
			],
		];

		$file_detail = \dash\upload\file::upload($_upload_name, $meta);

		return $file_detail;
	}

}
?>