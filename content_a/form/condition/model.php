<?php
namespace content_a\form\condition;


class model
{
	public static function post()
	{

		$post =
		[
			'if'        => \dash\request::post('if'),
			'operation' => \dash\request::post('operation'),
			'value'     => \dash\request::post('value'),
			'then'      => \dash\request::post('then'),
			'else'      => \dash\request::post('else'),
		];

		\lib\app\form\condition\add::add($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>
