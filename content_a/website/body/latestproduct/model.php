<?php
namespace content_a\website\body\latestproduct;

class model
{
	public static function post()
	{
		$post =
		[
			'limit'     => \dash\request::post('limit'),
			'headtitle' => \dash\request::post('headtitle'),
		];

		$theme_detail = \lib\app\website\body\latestproduct::set($post, \dash\request::get('key'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/latestproduct?key='. \dash\request::get('key'));
		}
	}
}
?>
