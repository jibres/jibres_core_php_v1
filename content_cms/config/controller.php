<?php
namespace content_cms\config;

class controller
{
	public static function routing()
	{
		\dash\permission::access('cmsSetting');
	}
}
?>