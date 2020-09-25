<?php
namespace content_su\tempfile;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\dash\file::delete(YARD. 'jibres_temp/stores/');
			\dash\notif::ok(T_("Temp file removed"));
			\dash\redirect::pwd();
		}
	}
}
?>