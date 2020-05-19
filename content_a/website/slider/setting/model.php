<?php
namespace content_a\website\slider\setting;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'slider')
		{
			$slider = \lib\app\website\body\line\slider::remove(\dash\data::sliderID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/slider?id='. \dash\data::sliderID());
			}

			return;
		}

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
				\dash\redirect::to(\dash\url::this());
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

		\dash\redirect::to(\dash\url::this(). '/slider?id='. $code);

	}
}
?>
