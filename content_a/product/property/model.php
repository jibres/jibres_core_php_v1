<?php
namespace content_a\product\property;


class model
{

	public static function getPost()
	{
		$args =
		[
			'desc'       => \dash\request::post('desc'),
			'cat'        => \dash\request::post('cat'),
			'key'        => \dash\request::post('key'),
			'value'      => \dash\request::post('value'),
			'product_id' => \dash\request::get('id'),
		];

		return $args;
	}


	public static function post()
	{
		$request         = self::getPost();

		\lib\app\property::add($request);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Property successfully added"));
			\dash\redirect::pwd();
		}
	}
}
?>
