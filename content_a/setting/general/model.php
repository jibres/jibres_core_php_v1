<?php
namespace content_a\setting\general;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$args =
		[
			'name'    => \lib\request::post('name'),
			'website' => \lib\request::post('website'),
			'desc'    => \lib\request::post('desc'),
			'mobile'  => \lib\request::post('mobile'),
			'address' => \lib\request::post('address'),
			'phone'   => \lib\request::post('phone'),
		];
		return $args;
	}


	public function post_general($_args)
	{
		\lib\app\store::edit(self::getPost());

		if(\lib\notif::$status)
		{
			\lib\redirect::pwd();
		}
	}
}
?>