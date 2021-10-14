<?php
namespace content_site\staticfile;

class controller
{
	public static function routing()
	{
		\dash\permission::access('siteBuilderSetting');

	}
}
?>