<?php
namespace content_a\setup\barcode;


class model
{
	public static function post()
	{
		// save every field in somewhere and set the barcode detail is complete
		$next_level = \lib\app\setting\setup::barcode();
		\dash\redirect::to($next_level);
	}
}
?>
