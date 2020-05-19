<?php
namespace content_a\website\body\edit;

class model
{
	public static function post()
	{
		$post =
		[
			'title'   => \dash\request::post('title'),
			'sort'    => \dash\request::post('sort'),
			'publish' => \dash\request::post('publish'),
			'ratio'   => \dash\request::post('ratio') === '0' ? null : \dash\request::post('ratio'),
		];


		if(\dash\request::post('remove') === 'line')
		{
			\lib\app\website\body\remove::line(\dash\request::post('id'));
		}
		else
		{
			\lib\app\website\body\edit::line($post, \dash\request::post('id'));
		}
	}
}
?>
