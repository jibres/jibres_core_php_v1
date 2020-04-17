<?php
namespace content_love\gift\create\setting;


class model
{
	public static function post()
	{

		$post =
		[
			'dateexpire' => \dash\request::post('dateexpire'),
			'physical'   => \dash\request::post('physical'),
			'chap'       => \dash\request::post('chap'),
		];

		$edit = \lib\app\gift\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/message?id='. \dash\request::get('id'));
		}

	}
}
?>