<?php
namespace content_b1\user\add;


class model
{
	public static function post()
	{
		$post           = [];

		$post['mobile'] = \dash\request::input_body('mobile');

		$result = \dash\app\user::add($post);

		unset($result['user_id']);

		\content_b1\tools::say($result);
	}
}
?>