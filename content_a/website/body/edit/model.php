<?php
namespace content_a\website\body\edit;

class model
{
	public static function post()
	{
		$post =
		[
			'title'   => \dash\request::post('title'),
			'sort'    => \dash\request::post('sort'),
			'publish' => \dash\request::post('publish'),
		];

		$remove = false;

		if(\dash\request::post('remove') === 'line')
		{
			$remove = true;
		}

		$theme_detail = \lib\app\website\body\set::edit($post, \dash\request::post('key'));

	}
}
?>
