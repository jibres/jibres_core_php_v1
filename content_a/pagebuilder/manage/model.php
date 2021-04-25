<?php
namespace content_a\pagebuilder\manage;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\pagebuilder\tools\remove::remove_page(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
		}

		$post =
		[
			'title' => \dash\request::post('title'),
		];

		$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

	}
}
?>