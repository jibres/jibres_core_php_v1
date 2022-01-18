<?php
namespace content_love\plugin\edit;


class model
{
	public static function post()
	{
		$post =
		[
			'status'     => \dash\request::post('status'),
			'expiredate' => \dash\request::post('expiredate'),
		];

		\lib\app\plugin\activate::admin_edit($post, \dash\request::get('pid'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}




	}
}
?>
