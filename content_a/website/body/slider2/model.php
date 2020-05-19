<?php
namespace content_a\website\body\slider2;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'slider')
		{
			$slider = \lib\app\website\body\line\slider::remove(\dash\data::sliderID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/slider2?id='. \dash\data::sliderID());
			}

			return;
		}

		if(\dash\url::dir(3) === 'set')
		{
			self::set();
		}
		elseif(\dash\url::dir(3) === 'add' || \dash\url::dir(3) === 'edit')
		{
			self::add();
		}



	}


	private static function add()
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

		$slider = \lib\app\website\body\line\slider::edit($post, \dash\data::sliderID(), \dash\request::get('index'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/slider2?id='. \dash\data::sliderID());
		}
	}


	private static function set()
	{

		$post =
		[
			'title'   => \dash\request::post('title'),
			// 'sort'    => \dash\request::post('sort'),
			// 'publish' => \dash\request::post('publish'),
			'ratio'   => \dash\request::post('ratio') === '0' ? null : \dash\request::post('ratio'),
		];

		if(\dash\request::get('id'))
		{

			if(\dash\request::post('remove') === 'line')
			{
				\lib\app\website\body\remove::line(\dash\request::post('id'));
				\dash\redirect::to(\dash\url::that());
			}
			else
			{
				\lib\app\website\body\edit::line($post, \dash\request::post('id'));
				$code = \dash\request::get('id');
			}
		}
		else
		{
			$code = \lib\app\website\body\add::line('slider', $post, true);
		}

		\dash\redirect::to(\dash\url::that(). '/slider2?id='. $code);
	}
}
?>
