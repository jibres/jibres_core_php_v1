<?php
namespace content_a\website\text\setting;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'text')
		{
			$text = \lib\app\website\body\line\text::remove(\dash\data::textID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/text?id='. \dash\data::textID());
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
			$code = \lib\app\website\body\add::line('text', $post, true);
		}

		\dash\redirect::pwd(\dash\url::this(). '/text?id='. $code);

	}
}
?>
