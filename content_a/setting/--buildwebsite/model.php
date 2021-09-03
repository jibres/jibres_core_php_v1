<?php
namespace content_a\setting\buildwebsite;


class model
{
	public static function post()
	{

		$post =
		[
			'facebook'  => \dash\request::post('facebook'),
			'twitter'   => \dash\request::post('twitter'),
			'linkedin'  => \dash\request::post('linkedin'),
			'instagram' => \dash\request::post('instagram'),
		];

		\lib\app\store\edit::social($post);

		if(!\dash\engine\process::status())
		{
			return false;
		}

		\dash\notif::clean();

		$post =
		[
			'desc'    => \dash\request::post('desc'),
			'title'    => \dash\request::post('title'),
		];

		\lib\app\store\edit::selfedit($post);

		if(!\dash\engine\process::status())
		{
			return false;
		}


		\dash\notif::clean();


		$result = \lib\app\setting\setup::upload_logo(true);

		// if(!\dash\engine\process::status())
		// {
		// 	return false;
		// }

		\dash\notif::clean();

		$post =
		[
			'status'    => 'visitcard',
		];

		$theme_detail = \lib\app\website\status\set::status($post);

		\lib\store::refresh();

		\dash\redirect::to(\dash\url::here());


	}
}
?>