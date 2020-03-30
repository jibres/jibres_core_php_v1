<?php
namespace content_a\website\body;

class model
{
	public static function post()
	{
		$post =
		[
			'body'    => \dash\request::post('body'),
		];

		$theme_detail = \lib\app\website_body\set::set_body_template($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/body/customize');
		}
	}
}
?>
