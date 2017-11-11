<?php
namespace content_a\staff\contact;


class model extends \content_a\main\model
{


	public static function getPost()
	{
		$post =
		[
			'phone'         => \lib\utility::post('phone'),
			'staffmobile' => \lib\utility::post('staffmobile'),
			'fathermobile'  => \lib\utility::post('fathermobile'),
			'mothermobile'  => \lib\utility::post('mothermobile'),
			'email'         => \lib\utility::post('email'),
		];
		return $post;
	}


	public function post_contact($_args)
	{
		\lib\app\staff::edit(self::getPost(), ['its_me' => true]);

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('baseFull'). '/'. \lib\router::get_url());
		}
	}
}
?>
