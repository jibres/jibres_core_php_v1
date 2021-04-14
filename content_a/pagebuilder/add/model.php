<?php
namespace content_a\pagebuilder\add;


class model
{
	public static function post()
	{

		if(\dash\request::post('line') === 'new' && \dash\request::post('key'))
		{
			$new_line = \lib\app\pagebuilder\line\add::add(\dash\request::post('key'));

			if(isset($new_line['url']))
			{
				\dash\redirect::to($new_line['url']);
			}
		}
	}
}
?>
