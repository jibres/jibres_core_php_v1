<?php
namespace content_a\android\setting;

class model
{
	public static function post()
	{
		$post =
		[
			'title'  => \dash\request::post('title'),
			'desc'   => \dash\request::post('desc'),
			'slogan' => \dash\request::post('slogan'),
		];

		$theme_detail = \lib\app\application\detail::set_android_detail($post);


		if(\dash\engine\process::status())
		{
			if(\dash\request::get('setup') === 'wizard')
			{
				\dash\redirect::to(\dash\url::this().'/splash?setup=wizard');
			}
			else
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
