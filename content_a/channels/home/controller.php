<?php
namespace content_a\channels\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('channelsView');

	}
}
?>