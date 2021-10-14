<?php
namespace content_a\setting\domain;

class controller
{
	public static function routing()
	{
		\dash\permission::access('siteBuilderSetting');
	}
}
?>