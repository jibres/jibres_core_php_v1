<?php
namespace content_a\thirdparty\edit\contact;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post =
		[
			'phone'  => \lib\utility::post('phone'),
			'mobile' => \lib\utility\filter::mobile(\lib\utility::post('mobile')),
			'email'  => \lib\utility::post('email'),
		];
		return $post;
	}


	public function post_contact($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \lib\utility::get('id'));

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>
