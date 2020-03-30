<?php
namespace content_a\website\header\customize;

class model
{
	public static function post()
	{
		$post = [];
		if(\dash\request::post('header_menu_1'))
		{
			$post['header_menu_1'] = \dash\request::post('header_menu_1');
		}

		if(\dash\request::post('header_menu_2'))
		{
			$post['header_menu_2'] = \dash\request::post('header_menu_2');
		}

		if(\dash\request::files('logo'))
		{
			$post['header_logo'] = 'have_logo';
		}


		$customize_header = \lib\app\website_header\set::customize_header($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
