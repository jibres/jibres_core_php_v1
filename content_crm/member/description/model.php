<?php
namespace content_crm\member\description;


class model
{
	public static function post()
	{

		if(\dash\request::post('removenote') === 'removenote')
		{
			\dash\app\user\description::remove(\dash\request::post('noteid'), \dash\request::get('id'));
		}
		else
		{
			\dash\app\user\description::add(\dash\request::post('note'), \dash\request::get('id'));
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>