<?php
namespace content_b1\user\notes\add;


class model
{
	public static function post()
	{
		$result = \dash\app\user\description::add(\dash\request::input_body('notes'), \dash\request::get('userid'));
		\content_b1\tools::say($result);
	}
}
?>