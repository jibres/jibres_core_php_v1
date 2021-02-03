<?php
namespace content_cms\advance;

class controller
{
	public static function routing()
	{
		\dash\permission::access('cmsSetting');
	}
}
?>