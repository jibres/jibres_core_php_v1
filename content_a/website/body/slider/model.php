<?php
namespace content_a\website\body\slider;

class model
{
	public static function post()
	{
		$post =
		[
			'url'    => \dash\request::post('url'),
			'target' => \dash\request::post('target'),
			'alt'    => \dash\request::post('alt'),
			'sort'   => \dash\request::post('sort'),
		];

		if(\dash\request::files('image'))
		{
			$post['image'] = 'image';
		}

		$remove = false;

		if(\dash\request::post('remove') === 'slider')
		{
			$remove = true;
		}

		$theme_detail = \lib\app\website\body\slider::set($post, \dash\request::get('key'), \dash\request::get('index'), $remove);


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/slider?key='. \dash\request::get('key'));
		}
	}
}
?>
