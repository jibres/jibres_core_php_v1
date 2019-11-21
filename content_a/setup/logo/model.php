<?php
namespace content_a\setup\logo;


class model
{
	public static function post()
	{
		\lib\app\setting\setup::upload_logo();

		$next_level = \lib\app\setting\setup::logo();

		\lib\store::refresh();

		\dash\notif::direct();

		\dash\redirect::to($next_level);
	}

}
?>
