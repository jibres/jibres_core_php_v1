<?php
namespace content_a\app\android\intro;

class model
{
	public static function post()
	{
		$post =
		[
			'intro1' =>
			[
				'title' => \dash\request::post('title1'),
				'desc'  => \dash\request::post('desc1'),
				'file'  => \dash\upload\store_logo::app_intro_logo('1'),
			],

			'intro2' =>
			[
				'title' => \dash\request::post('title2'),
				'desc'  => \dash\request::post('desc2'),
				'file'  => \dash\upload\store_logo::app_intro_logo('2'),
			],

			'intro3' =>
			[
				'title' => \dash\request::post('title3'),
				'desc'  => \dash\request::post('desc3'),
				'file'  => \dash\upload\store_logo::app_intro_logo('3'),
			],
		];

		$theme_detail = \lib\app\application\intro::set_android($post);

		if(\dash\engine\process::status())
		{
			if(\dash\request::get('setup') === 'wizard')
			{
				\dash\redirect::to(\dash\url::that(). '/review?setup=wizard');
			}
			else
			{
				\dash\redirect::pwd();
			}

		}
	}
}
?>
