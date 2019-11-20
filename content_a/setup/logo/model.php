<?php
namespace content_a\setup\logo;


class model
{
	public static function post()
	{
		// save every field in somewhere and set the logo detail is complete
		$next_level = \lib\app\setting\setup::logo();
		\dash\redirect::to($next_level);
	}
}
?>
