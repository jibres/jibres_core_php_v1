<?php
namespace content_a\app\splash;

class model
{
	public static function post()
	{
		$post =
		[
			'splash1' =>
			[
				'title' => \dash\request::post('title1'),
				'desc'  => \dash\request::post('desc1'),
				'file'  => \dash\upload\quick::upload('file1'),
			],

			'splash2' =>
			[
				'title' => \dash\request::post('title2'),
				'desc'  => \dash\request::post('desc2'),
				'file'  => \dash\upload\quick::upload('file2'),
			],

			'splash3' =>
			[
				'title' => \dash\request::post('title3'),
				'desc'  => \dash\request::post('desc3'),
				'file'  => \dash\upload\quick::upload('file3'),
			],
		];


		$theme_detail = \lib\app\application\splash::set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
