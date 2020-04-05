<?php
namespace content_a\setting\domain;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'domain')
		{
			$post =
			[
				'domain' => \dash\request::post('domain'),
				'id'     => \dash\request::post('id'),
			];

			\lib\app\store\domain::remove($post);
		}
		else
		{
			$post =
			[
				'domain' => \dash\request::post('domain'),
			];

			\lib\app\store\domain::set($post);
		}


		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>