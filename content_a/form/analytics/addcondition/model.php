<?php
namespace content_a\form\analytics\addcondition;


class model
{
	public static function post()
	{

		if(\dash\request::post('execfilter') === 'execfilter')
		{
			\lib\app\form\filter\run::run(\dash\request::get('id'), \dash\request::get('fid'));
			\dash\redirect::pwd();
			return;
		}

		if(\dash\request::post('removefilter') === 'removefilter')
		{
			\lib\app\form\filter\remove::remove(\dash\request::get('fid'));
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			return;
		}
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\form\filter\remove::remove_where(\dash\request::post('id'));
			\dash\redirect::pwd();
			return;
		}

		$value = \dash\request::post('value');
		if(is_array($value))
		{
			$value = implode('-', $value);
		}

		$post =
		[
			'field'     => \dash\request::post('field'),
			'operator'  => \dash\request::post('operator'),
			'condition' => \dash\request::post('condition'),
			'value'     => $value,
		];

		\lib\app\form\filter\add::add_where($post, \dash\request::get('id'), \dash\request::get('fid'));

		\dash\redirect::to(\dash\url::that(). '/filter?'. \dash\request::fix_get(['filter' => null]));
	}

}
?>
