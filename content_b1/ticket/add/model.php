<?php
namespace content_b1\ticket\add;


class model
{


	public static function post()
	{

		$post =
		[
			'content' => \dash\request::input_body('content'),
			'user_id' => \dash\request::input_body('user_id'),
			'title'   => \dash\request::input_body('title'),
		];

		$result = \dash\app\ticket\add::add_by_admin($post);

		\content_b1\tools::say($result);
	}
}
?>