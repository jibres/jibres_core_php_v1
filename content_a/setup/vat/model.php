<?php
namespace content_a\setup\vat;


class model
{
	public static function post()
	{
		// save every field in somewhere and set the vat detail is complete
		$next_level = \lib\app\setting\setup::vat();
		\dash\redirect::to($next_level);
	}
}
?>
