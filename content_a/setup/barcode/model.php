<?php
namespace content_a\setup\barcode;


class model
{
	public static function post()
	{
		\lib\app\setting\setup::have_barcode(\dash\request::post('barcode'));
		$next_level = \lib\app\setting\setup::barcode();
		\dash\redirect::to($next_level);
	}
}
?>
