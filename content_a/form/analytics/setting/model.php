<?php
namespace content_a\form\analytics\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('removefilter') === 'removefilter')
		{
			\lib\app\form\filter\remove::remove(\dash\request::get('fid'));
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			return;
		}

	}

}
?>
