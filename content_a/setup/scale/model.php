<?php
namespace content_a\setup\scale;


class model
{
	public static function post()
	{
		// save every field in somewhere and set the scale detail is complete
		$next_level = \lib\app\setting\setup::scale();
		\dash\redirect::to($next_level);
	}
}
?>
