<?php
namespace content_a\form\condition;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove_condition') === 'remove_condition')
		{
			\lib\app\form\condition\remove::remove(\dash\request::post('key'), \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

			return;
		}

		$post =
		[
			'if'        => \dash\request::post('if'),
			'operation' => 'isequal',
			'value'     => \dash\request::post('value'),
			'then'      => \dash\request::post('then'),
			'else'      => \dash\request::post('else'),
		];

		\lib\app\form\condition\add::add($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). \dash\request::full_get(['if' => null]));
		}
	}

}
