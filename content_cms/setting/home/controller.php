<?php
namespace content_cms\setting\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('cmsSetting');

	}
}
?>