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

		if(\dash\request::post('footer_menu_3'))
		{
			$post['footer_menu_3'] = \dash\request::post('footer_menu_3');
			$notif_msg = T_("Your footer menu was saved");
		}

		if(\dash\request::post('footer_menu_3') === '0')
		{
			$post['footer_menu_3'] = null;
			$notif_msg = T_("Your footer menu was removed");
		}


		if(\dash\request::post('footer_menu_4'))
		{
			$post['footer_menu_4'] = \dash\request::post('footer_menu_4');
			$notif_msg = T_("Your footer menu was saved");
		}

		if(\dash\request::post('footer_menu_4') === '0')
		{
			$post['footer_menu_4'] = null;
			$notif_msg = T_("Your footer menu was removed");
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
