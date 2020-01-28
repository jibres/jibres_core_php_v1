<?php
namespace lib\app\import;

class add
{
	public static function product()
	{
		$meta =
		[
			'ext' => 'csv',
			'allow_size' => (5*1024*1024)
		];

		$file_detail = \dash\upload\file::upload('import', $meta);

		if(!$file_detail || !isset($file_detail['path']) || !isset($file_detail['id']))
		{
			return false;
		}

		$id = $file_detail['id'];
		$path = root. 'public_html/'. $file_detail['path'];


	}
}
?>