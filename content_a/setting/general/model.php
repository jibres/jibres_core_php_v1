<?php
namespace content_a\setting\general;


class model
{
	public static function post()
	{
		\dash\permission::access('aSettingEdit');
		\lib\app\store::edit(self::getPost());

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


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
}
?>