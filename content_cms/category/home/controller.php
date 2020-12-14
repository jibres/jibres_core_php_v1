<?php
namespace content_cms\category\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_cms');
	}
}
?>