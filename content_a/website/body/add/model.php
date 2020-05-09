<?php
namespace content_a\website\body\add;

class model
{
	public static function post()
	{
		$post =
		[
			'line'    => \dash\request::post('line'),
		];

		$theme_detail = \lib\app\website\body\set::add_line($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>
