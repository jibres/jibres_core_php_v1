<?php
namespace content_a\website\productline\setting;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'productline')
		{
			$productline = \lib\app\website\body\line\productline::remove(\dash\data::productlineID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/productline?id='. \dash\data::productlineID());
			}

			return;
		}

		$post =
		[
			'title'   => \dash\request::post('title'),
			// 'sort'    => \dash\request::post('sort'),
			'publish' => 1,
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
			$code = \lib\app\website\body\add::line('productline', $post, true);
		}

		\dash\redirect::pwd(\dash\url::this(). '/productline?id='. $code);

	}
}
?>
