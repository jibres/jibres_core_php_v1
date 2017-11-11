<?php
namespace content_a\staff\contact;


class model extends \content_a\main\model
{


	public static function getPost()
	{
		$post =
		[
			'phone'        => \lib\utility::post('phone'),
			'mobile'       => \lib\utility::post('mobile'),
			'fathermobile' => \lib\utility::post('fathermobile'),
			'mothermobile' => \lib\utility::post('mothermobile'),
			'email'        => \lib\utility::post('email'),
			'id'           => \lib\utility::get('id'),

		];
		return $post;
	}


	public function post_contact($_args)
	{
		\lib\app\staff::edit(self::getPost());

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>
