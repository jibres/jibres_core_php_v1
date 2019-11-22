<?php
namespace content_a\setup\vat;


class model
{
	public static function post()
	{
		\lib\app\setting\setup::have_vat(\dash\request::post('vat'));
		\lib\store::refresh();
		$next_level = \lib\app\setting\setup::vat();
		\dash\redirect::to($next_level);
	}
}
?>
