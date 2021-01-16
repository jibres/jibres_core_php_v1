<?php
namespace content_cms\customization\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('cmsSetting');

	}
}
?>