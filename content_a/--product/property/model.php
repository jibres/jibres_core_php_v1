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
		if(\dash\request::post('type') === 'remove' && \dash\request::post('id'))
		{
			\lib\app\property::remove(\dash\request::post('id'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Property successfully removed"));
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));

			}
			return;
		}

		$request         = self::getPost();

		if(\dash\request::get('pid'))
		{
			\lib\app\property::edit($request, \dash\request::get('pid'));

			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Property successfully updated"));
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			}
		}
		else
		{
			\lib\app\property::add($request);

			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Property successfully added"));
				\dash\redirect::pwd();
			}
		}
	}
}
?>
