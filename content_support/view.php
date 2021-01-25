<?php
namespace content_support;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\data::badge_shortkey(120);
		\dash\data::badge2_shortkey(121);

		\dash\data::maxUploadSize(\dash\upload\size::support_file_size(true));
	}
}
?>