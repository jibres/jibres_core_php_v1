<?php
namespace content_a\form\tag;

class controller
{
	public static function routing()
	{
		\dash\permission::access('tagView');
	}
}
?>