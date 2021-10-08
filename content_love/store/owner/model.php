<?php
namespace content_love\store\owner;


class model
{
	public static function post()
	{
		if(\dash\request::post('changeowner') === 'changeowner')
		{
			\lib\app\store\edit::change_owner(\dash\request::get('id'), \dash\request::get('newowner'));
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			return;
		}



	}
}
?>
