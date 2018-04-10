<?php
namespace content_a\thirdparty\contact;


class model
{
	public static function post()
	{
		\lib\app\thirdparty::edit(self::getPost(), \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function getPost()
	{
		$post =
		[
			'phone'  => \dash\request::post('phone'),
			'mobile' => \dash\utility\filter::mobile(\dash\request::post('mobile')),
			'email'  => \dash\request::post('email'),
		];
		return $post;
	}
}
?>
