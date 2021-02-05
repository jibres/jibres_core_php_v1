<?php
namespace content_b1\user\remove;


class model
{
	public static function delete()
	{
		$user_code = \dash\request::get('id');

		$post =
		[
			'status' => 'removed',
		];


		$result    = \dash\app\user::edit($post, $user_code);

		\content_b1\tools::say($result);

	}
}
?>