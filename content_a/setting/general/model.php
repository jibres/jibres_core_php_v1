<?php
namespace content_a\setting\general;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$args =
		[
			'name'    => \dash\request::post('name'),
			'website' => \dash\request::post('website'),
			'desc'    => \dash\request::post('desc'),
			'mobile'  => \dash\request::post('mobile'),
			'address' => \dash\request::post('address'),
			'phone'   => \dash\request::post('phone'),
		];
		return $args;
	}


	public function post_general($_args)
	{
		\lib\app\store::edit(self::getPost());

		if(\lib\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>