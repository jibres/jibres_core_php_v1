<?php
namespace content_b1\tags\detail;


class view
{

	public static function config()
	{
		$result      = \dash\app\terms\get::get(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>