<?php
namespace content_love\gift\create\usage;


class model
{
	public static function post()
	{

		$post =
		[
			'usagetotal'   => \dash\request::post('usagetotal'),
			'usageperuser' => \dash\request::post('usageperuser'),
			'dedicated'    => \dash\request::post('dedicated'),
			'forusein'     => \dash\request::post('forusein'),
		];

		$edit = \lib\app\gift\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/code?id='. \dash\request::get('id'));
		}

	}
}
?>