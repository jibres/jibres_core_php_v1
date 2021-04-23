<?php
namespace content_a\pagebuilder\edittitle;


class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
		];

		$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

	}
}
?>