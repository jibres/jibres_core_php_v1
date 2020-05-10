<?php
namespace content_a\website\body\latestnews;

class model
{
	public static function post()
	{
		$post =
		[
			'limit'    => \dash\request::post('limit'),
		];

		$theme_detail = \lib\app\website\body\latestnews::set($post, \dash\request::get('key'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/latestnews?key='. \dash\request::get('key'));
		}
	}
}
?>
