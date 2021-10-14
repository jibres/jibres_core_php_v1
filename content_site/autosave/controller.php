<?php
namespace content_site\autosave;

class controller
{
	public static function routing()
	{
		\dash\permission::access('siteBuilderSetting');
	}
}
?>