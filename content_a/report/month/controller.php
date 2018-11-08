<?php
namespace content_a\report\month;


class controller
{
	public static function routing()
	{
		\dash\permission::access('reportMonth');
	}
}
?>
