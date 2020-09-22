<?php
namespace content_a\form\analytics\filter;


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

		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\form\filter\remove::remove_where(\dash\request::post('id'));
			\dash\redirect::pwd();
			return;
		}

	}
}
?>
