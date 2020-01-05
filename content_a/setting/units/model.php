<?php
namespace content_a\setting\units;


class model
{
	public static function post()
	{
		$post                = [];
		$post['currency']    = \dash\request::post('currency');
		$post['mass_unit']   = \dash\request::post('mass_unit');
		$post['length_unit'] = \dash\request::post('length_unit');

		\lib\app\setting\setup::save_units($post);
	}
}
?>
