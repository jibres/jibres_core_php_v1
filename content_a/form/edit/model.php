<?php
namespace content_a\form\edit;

class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
			'slug' => \dash\request::post('slug'),
		];

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		\dash\redirect::pwd();
	}
}
?>