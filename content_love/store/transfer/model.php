<?php
namespace content_love\store\transfer;


class model
{
	public static function post()
	{
		if(\dash\request::post('run') === 'run')
		{
			\lib\app\store\changefuel::run();
			return;
		}

		if(\dash\request::post('changestatus') === 'changestatus')
		{
			\lib\app\store\changefuel::force_update_status(\dash\request::get('id'), \dash\request::post('status'));
			\dash\redirect::pwd();
		}

		if(\dash\request::post('forceupdatefuel'))
		{
			\lib\app\store\changefuel::force_update_fuel(\dash\request::get('id'), \dash\request::post('newfuel'));
			\dash\redirect::pwd();
		}

		if(\dash\request::post('newfuel'))
		{
			\lib\app\store\changefuel::request(\dash\request::get('id'), \dash\request::post('newfuel'));
		}

	}
}
?>
