<?php
namespace content_b1\hashtag\add;


class model
{

	public static function post()
	{
		$post          = [];
		$post['title'] = \dash\request::input_body('title');
		$result        = \dash\app\terms\add::add($post);

		\content_b1\tools::say($result);
	}
}
?>