<?php
namespace content_a\form\analytics\filter;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\form\filter\remove::remove_where(\dash\request::post('id'));
			\dash\redirect::pwd();
			return;
		}

		$post =
		[
			'field'     => \dash\request::post('field'),
			'operator'  => \dash\request::post('operator'),
			'condition' => \dash\request::post('condition'),
			'value'     => \dash\request::post('value'),
		];

		\lib\app\form\filter\add::add_where($post, \dash\request::get('id'), \dash\request::get('fid'));

		\dash\redirect::pwd();
	}

}
?>
