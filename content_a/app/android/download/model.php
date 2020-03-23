<?php
namespace content_a\app\android\download;

class model
{
	public static function post()
	{
		$post =
		[
			'googleplay'    => \dash\request::post('googleplay'),
			'cafebazar'     => \dash\request::post('cafebazar'),
			'myket'         => \dash\request::post('myket'),
			'downloadtitle' => \dash\request::post('title'),
			'downloaddesc'  => \dash\request::post('desc'),
		];

		$theme_detail = \lib\app\application\detail::set_android_download_detail($post);


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
