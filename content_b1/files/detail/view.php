<?php
namespace content_b1\files\detail;


class view
{

	public static function config()
	{
		$result      = \dash\app\files\get::get(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>