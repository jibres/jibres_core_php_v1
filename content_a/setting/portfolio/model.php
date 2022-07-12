<?php
namespace content_a\setting\portfolio;


class model
{
	public static function post()
	{
		// if(\dash\request::post('portfolio') === 'request')
		{
			$post =
			[
				'portfolio'   => 'request',
			];
		}
		// else
		// {
		// 	$post =
		// 	[
		// 		'portfolio'   => 'delete',
		// 	];
		// }


		\lib\app\store\edit::selfedit($post);


		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}
}
?>