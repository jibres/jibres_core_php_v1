<?php
namespace content_a\site\additem;


class model
{
	public static function post()
	{
		if(\dash\request::post('line') === 'new' && \dash\request::post('key'))
		{
			if(\dash\data::pagebuilderMode() === 'header')
			{
				$new_line = \lib\pagebuilder\tools\add::header(\dash\request::post('key'));
			}
			elseif(\dash\data::pagebuilderMode() === 'body')
			{
				$new_line = \lib\pagebuilder\tools\add::body(\dash\request::post('key'));
			}
			elseif(\dash\data::pagebuilderMode() === 'footer')
			{
				$new_line = \lib\pagebuilder\tools\add::footer(\dash\request::post('key'));
			}

			if(isset($new_line['url']))
			{
				\dash\redirect::to($new_line['url']);
			}
		}
	}
}
?>