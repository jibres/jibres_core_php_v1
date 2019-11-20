<?php
namespace content_a\setup\owner;


class model
{
	public static function post()
	{
		// save every field in somewhere and set the owner detail is complete
		$next_level = \lib\app\setting\setup::owner(true);
		\dash\redirect::to($next_level);
	}
}
?>
