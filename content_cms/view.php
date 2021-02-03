<?php
namespace content_cms;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\upload\size::set_default_file_size('cms');

	}
}
?>