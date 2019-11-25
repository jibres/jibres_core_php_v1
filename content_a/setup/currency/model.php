<?php
namespace content_a\setup\currency;


class model
{
	public static function post()
	{
		$post                          = [];
		$post['currency']   = \dash\request::post('currency');

		\lib\app\setting\setup::save_currency($post);
		\lib\store::refresh();
		// save every field in somewhere and set the currency detail is complete
		$next_level = \lib\app\setting\setup::currency();
		\dash\redirect::to($next_level);
	}
}
?>
