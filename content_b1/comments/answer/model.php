<?php
namespace content_b1\comments\answer;


class model
{

	public static function post()
	{
		$post                = [];
		$post['content']     = \dash\request::input_body('content');
		$post['title']       = \dash\request::input_body('title');

		$result              = \dash\app\comment\add::answer($post, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>