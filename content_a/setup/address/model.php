<?php
namespace content_a\setup\address;


class model
{
	public static function post()
	{
		// save every field in somewhere and set the address detail is complete
		$next_level = \lib\app\setting\setup::address();
		\dash\redirect::to($next_level);
	}
}
?>
