<?php
namespace content_a\form\analytics\filter;


class model
{
	public static function post()
	{
		if(\dash\request::post('create') === 'create')
		{

			\lib\app\form\view\create::new_view(\dash\request::get('id'));

			\dash\notif::ok(T_("Ok"));
			\dash\redirect::pwd();

		}

	}

}
?>
