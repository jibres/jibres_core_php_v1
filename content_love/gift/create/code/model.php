<?php
namespace content_love\gift\create\code;


class model
{
	public static function post()
	{

		$post =
		[
			'code'   => \dash\request::post('code'),
		];

		$edit = \lib\app\gift\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/setting?id='. \dash\request::get('id'));
		}

	}
}
?>