<?php
namespace content_cms;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		$maxFileSize = 10;//\dash\upload\size::cms_file_size();
		\dash\data::maxFileSize($maxFileSize);
		\dash\data::maxFileSizeTitle(\dash\fit::file_size($maxFileSize * 1024 * 1024));

	}
}
?>