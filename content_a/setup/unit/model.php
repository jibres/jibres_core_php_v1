<?php
namespace content_a\setup\unit;


class model
{
	public static function post()
	{
		$post                          = [];
		$post['unit']   = \dash\request::post('unit');

		\lib\app\setting\setup::save_unit($post);
		\lib\store::refresh();
		// save every field in somewhere and set the unit detail is complete
		$next_level = \lib\app\setting\setup::unit();
		\dash\redirect::to($next_level);
	}
}
?>
