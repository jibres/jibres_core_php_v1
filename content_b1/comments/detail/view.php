<?php
namespace content_b1\comments\detail;


class view
{

	public static function config()
	{
		$result      = \dash\app\comment\get::get(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>