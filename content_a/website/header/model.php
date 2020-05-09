<?php
namespace content_a\website\header;

class model
{
	public static function post()
	{
		$notif_msg = null;

		$post = [];
		if(\dash\request::post('header_menu_1'))
		{
			$post['header_menu_1'] = \dash\request::post('header_menu_1');
			$notif_msg = T_("Your header menu #1 was saved");
		}

		if(\dash\request::post('header_menu_1') === '0')
		{
			$post['header_menu_1'] = null;
			$notif_msg = T_("Your header menu #1 was removed");
		}

		if(\dash\request::post('header_menu_2'))
		{
			$post['header_menu_2'] = \dash\request::post('header_menu_2');
			$notif_msg = T_("Your header menu #2 was saved");
		}

		if(\dash\request::post('header_menu_2') === '0')
		{
			$post['header_menu_2'] = null;
			$notif_msg = T_("Your header menu #2 was removed");
		}

		if(\dash\request::files('logo'))
		{
			$post['header_logo'] = 'have_logo';
			$notif_msg = T_("Your header logo was saved");
		}


		$customize_header = \lib\app\website\header\set::customize_header($post);

		if(\dash\engine\process::status())
		{
			if($notif_msg)
			{
				\dash\notif::clean();
				\dash\notif::ok($notif_msg);
			}
			// \dash\redirect::pwd();
		}
	}
}
?>
