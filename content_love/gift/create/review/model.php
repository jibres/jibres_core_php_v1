<?php
namespace content_love\gift\create\review;


class model
{
	public static function post()
	{

		$post =
		[
			'status'       => \dash\request::post('status'),
		];

		$edit = \lib\app\gift\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/all');
		}

	}
}
?>