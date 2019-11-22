<?php
namespace content_a\setup\scale;


class model
{
	public static function post()
	{
		\lib\app\setting\setup::have_scale(\dash\request::post('scale'));
		\lib\store::refresh();
		$next_level = \lib\app\setting\setup::scale();
		\dash\redirect::to($next_level);
	}
}
?>
