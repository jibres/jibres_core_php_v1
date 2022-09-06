<?php
namespace content_sudo\tempfile;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\dash\file::delete(YARD. 'jibres_temp/stores/');
			\dash\file::delete(YARD. 'jibres_temp/busy/');
			\dash\notif::ok(T_("Temp file removed"));
			\dash\redirect::pwd();
		}
	}
}
?>