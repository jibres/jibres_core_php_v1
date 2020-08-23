<?php
namespace content_a\accounting\doc\add;

class model
{
	public static function post()
	{
		$post =
		[
			'number'    => \dash\request::post('number'),
			'subnumber' => \dash\request::post('subnumber'),
			'year_id'   => \dash\request::post('year_id'),
			'desc'      => \dash\request::post('desc'),
			'date'      => \dash\request::post('date'),
			'type'      => \dash\request::get('type'),
		];

		$result = \lib\app\tax\doc\add::add($post);

		if(\dash\engine\process::status() && isset($result['id']))
		{
			\dash\redirect::to(\dash\url::that(). '/edit?id='. $result['id']);
		}
	}
}
?>
