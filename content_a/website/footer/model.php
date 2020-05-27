<?php
namespace content_a\website\footer;

class model
{
	public static function post()
	{
		$notif_msg     = null;

		$post = [];
		if(\dash\request::post('footer_menu_1'))
		{
			$post['footer_menu_1'] = \dash\request::post('footer_menu_1');
			$notif_msg = T_("Your footer menu was saved");
		}

		if(\dash\request::post('footer_menu_1') === '0')
		{
			$post['footer_menu_1'] = null;
			$notif_msg = T_("Your footer menu was removed");
		}

		if(\dash\request::post('footer_menu_2'))
		{
			$post['footer_menu_2'] = \dash\request::post('footer_menu_2');
			$notif_msg = T_("Your footer menu was saved");
		}

		if(\dash\request::post('footer_menu_2') === '0')
		{
			$post['footer_menu_2'] = null;
			$notif_msg = T_("Your footer menu was removed");
		}

		if(\dash\request::files('logo'))
		{
			$post['footer_logo'] = 'have_logo';
			$notif_msg = T_("Your footer logo was saved");
		}

		if(\dash\request::post('remove_footer') === 'logo')
		{
			$post['footer_logo'] = 'remove_logo';
			$notif_msg = T_("Your footer logo was removed");
		}


		$customize_footer = \lib\app\website\footer\set::customize_footer($post);

		if(\dash\engine\process::status())
		{
			if($notif_msg)
			{
				\dash\notif::clean();
				\dash\notif::ok($notif_msg);
			}

			\dash\redirect::pwd();
		}
	}
}
?>
