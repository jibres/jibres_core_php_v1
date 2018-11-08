<?php
namespace content_a\report\daily;


class controller
{
	public static function routing()
	{
		\dash\permission::access('reportMonth');
	}
}
?>
