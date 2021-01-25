<?php
namespace content_b1\ticket\add;


class model
{


	public static function post()
	{
		$post            = [];
		$post['content'] = \dash\request::input_body('content');
		$post['title']   = \dash\request::input_body('title');
		$post['via']     = 'api';

		$result  = \dash\app\ticket\add::add($post);

		\content_b1\tools::say($result);
	}
}
?>