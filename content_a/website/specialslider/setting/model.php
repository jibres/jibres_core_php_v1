<?php
namespace content_a\website\specialslider\setting;

class model
{
	public static function post()
	{
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
				\dash\redirect::to(\dash\url::this(). '/body');
			}
			else
			{
				\lib\app\website\body\edit::line($post, \dash\request::post('id'));
				$code = \dash\request::get('id');
			}
		}
		else
		{
			$code = \lib\app\website\body\add::line('specialslider', $post, true);
		}

		\dash\redirect::to(\dash\url::this(). '/specialslider/setting?id='. $code);

	}
}
?>
