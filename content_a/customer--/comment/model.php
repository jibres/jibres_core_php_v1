<?php
namespace content_a\customer\comment;


class model
{
	public static function post()
	{
		if(\dash\request::post('type') === 'remove' && \dash\request::post('id'))
		{
			\lib\app\customer\comment::remove(\dash\request::post('id'), \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		\lib\app\customer\comment::add(\dash\request::post('note'), \dash\request::get('id'));

		if(\dash\request::post('redirecturl'))
		{
			\dash\redirect::to($_POST['redirecturl']);
		}
	}
}
?>
