<?php
namespace content_love\gift\create\message;


class model
{
	public static function post()
	{

		$post =
		[
			'desc'       => \dash\request::post('desc'),
			'msgsuccess' => \dash\request::post('msgsuccess'),
		];

		$edit = \lib\app\gift\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/review?id='. \dash\request::get('id'));
		}

	}
}
?>