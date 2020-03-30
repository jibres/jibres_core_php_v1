<?php
namespace content_a\website\footer\customize;

class model
{
	public static function post()
	{
		$post = [];
		if(\dash\request::post('footer_menu_1'))
		{
			$post['footer_menu_1'] = \dash\request::post('footer_menu_1');
		}

		if(\dash\request::post('footer_menu_1') === '0')
		{
			$post['footer_menu_1'] = null;
		}

		if(\dash\request::post('footer_menu_2'))
		{
			$post['footer_menu_2'] = \dash\request::post('footer_menu_2');
		}

		if(\dash\request::post('footer_menu_2') === '0')
		{
			$post['footer_menu_2'] = null;
		}

		if(\dash\request::files('logo'))
		{
			$post['footer_logo'] = 'have_logo';
		}


		$customize_footer = \lib\app\website_footer\set::customize_footer($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
