<?php
namespace content_a\form\analytics\remove;


class model
{
	public static function post()
	{
		if(\dash\request::post('removeanalytics') === 'removeanalytics')
		{
			\lib\app\form\view\remove::remove(\dash\request::get('id'));
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			return;
		}

	}

}
?>
