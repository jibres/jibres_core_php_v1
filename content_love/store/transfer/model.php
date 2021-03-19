<?php
namespace content_love\store\transfer;


class model
{
	public static function post()
	{
		if(\dash\request::post('newfuel'))
		{
			\lib\app\store\changefuel::request(\dash\request::get('id'), \dash\request::post('newfuel'));
		}

	}
}
?>
