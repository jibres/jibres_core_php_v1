<?php
namespace content_a\product\tag;


class model
{
	public static function post()
	{
		\lib\app\product\tag::add(\dash\request::post('tag'), \dash\request::get('id'));

		if(\dash\request::post('redirecturl'))
		{
			\dash\redirect::to($_POST['redirecturl']);
		}
	}
}
?>
