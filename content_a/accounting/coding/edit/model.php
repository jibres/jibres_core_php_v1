<?php
namespace content_a\accounting\coding\edit;

class model
{
	public static function post()
	{

		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\tax\coding\remove::remove(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
		}

		$post =
		[
			'parent' => \dash\request::post('parent'),
			'title'  => \dash\request::post('title'),
			'code'   => \dash\request::post('code'),
		];

		$result = \lib\app\tax\coding\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
