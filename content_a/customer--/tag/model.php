<?php
namespace content_a\customer\tag;


class model
{
	public static function post()
	{
		\lib\app\customer\tag::add(\dash\request::post('tag'), \dash\request::get('id'));

		if(\dash\request::post('redirecturl'))
		{
			\dash\redirect::to($_POST['redirecturl']);
		}
	}
}
?>
