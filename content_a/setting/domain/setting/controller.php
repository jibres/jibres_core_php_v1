<?php
namespace content_a\setting\domain\setting;

class controller
{
	public static function routing()
	{
		\dash\permission::access('siteBuilderSetting');
	}
}
?>