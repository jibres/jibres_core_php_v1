<?php
namespace content_a\accounting\year\edit;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\tax\year\remove::remove(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
			return;
		}


		$post =
		[
			'title'     => \dash\request::post('title'),
		];

		$result = \lib\app\tax\year\edit::edit($post, \dash\request::get('id'));


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
