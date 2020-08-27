<?php
namespace content_a\form\answer\export;


class model
{
	public static function post()
	{
		\lib\app\form\answer\export::queue(\dash\request::get('id'));
		\dash\redirect::pwd();
	}
}
?>
