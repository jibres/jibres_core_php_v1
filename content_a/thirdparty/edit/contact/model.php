<?php
namespace content_a\thirdparty\edit\contact;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post =
		[
			'phone'  => \lib\request::post('phone'),
			'mobile' => \lib\utility\filter::mobile(\lib\request::post('mobile')),
			'email'  => \lib\request::post('email'),
		];
		return $post;
	}


	public function post_contact($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \lib\request::get('id'));

		if(\lib\debug::$status)
		{
			$this->redirector(\lib\url::pwd());
		}
	}
}
?>
