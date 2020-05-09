<?php
namespace content_a\website\body\edit;

class model
{
	public static function post()
	{
		$post =
		[
			'url'    => \dash\request::post('url'),
			'target' => \dash\request::post('target'),
		];

		if(\dash\request::files('image'))
		{
			$post['image'] = 'image';
		}

		$theme_detail = \lib\app\website\body\line_option::set($post, \dash\request::get('key'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
