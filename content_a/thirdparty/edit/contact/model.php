<?php
namespace content_a\thirdparty\edit\contact;


class model extends \content_a\main\model
{
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


	public function post_contact($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \dash\request::get('id'));

		if(\lib\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
