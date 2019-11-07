<?php
namespace content_a\thirdparty\comment;


class model
{
	public static function post()
	{
		if(\dash\request::post('type') === 'remove' && \dash\request::post('id'))
		{
			\lib\app\thirdparty\comment::remove(\dash\request::post('id'), \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		\lib\app\thirdparty\comment::add(\dash\request::post('note'), \dash\request::get('id'));

		if(\dash\request::post('redirecturl'))
		{
			\dash\redirect::to($_POST['redirecturl']);
		}
	}
}
?>
