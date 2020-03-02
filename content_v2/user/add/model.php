<?php
namespace content_v2\user\add;


class model
{
	public static function post()
	{
		$post           = [];

		$post['mobile'] = \content_v2\tools::input_body('mobile');

		$result = \dash\app\user::add($post);

		unset($result['user_id']);

		\content_v2\tools::say($result);
	}
}
?>