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
				'file'  => \dash\upload\quick::upload('file1'),
			],

			'intro2' =>
			[
				'title' => \dash\request::post('title2'),
				'desc'  => \dash\request::post('desc2'),
				'file'  => \dash\upload\quick::upload('file2'),
			],

			'intro3' =>
			[
				'title' => \dash\request::post('title3'),
				'desc'  => \dash\request::post('desc3'),
				'file'  => \dash\upload\quick::upload('file3'),
			],
		];


		$theme_detail = \lib\app\application\intro::set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
