<?php
namespace lib\app\website\footer;

class set
{

	public static function set_footer_template($_args)
	{
		$condition =
		[
			'footer' => ['enum' => \lib\app\website\footer\template::get_keys()],
		];

		$require = ['footer'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$save = \lib\db\setting\update::overwirte_platform_cat_key($data['footer'], 'website', 'footer', 'active');

		if($save)
		{
			\lib\app\website\generator::remove_catch();
			\dash\notif::ok(T_("Your footer was saved"));
			return true;
		}
		else
		{
			\dash\log::oops('db');
			return false;
		}
	}


	public static function customize_footer($_args)
	{
		$menu = ['enum' => \lib\app\website\menu\get::list_all_menu_keys()];
		$condition =
		[
			'footer_menu_1' => $menu,
			'footer_menu_2' => $menu,
			'footer_logo'   => 'string',
		];

		$require = [];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$need_save = \dash\cleanse::patch_mode($_args, $data);

		$have_change = null;
		foreach ($need_save as $key => $value)
		{

			if($key === 'footer_logo')
			{
				$logo = \dash\upload\store_logo::website_logo();

				if($logo)
				{
					$value = $logo;
				}
			}

			$query_result = \lib\db\setting\update::overwirte_platform_cat_key($value, 'website', 'footer_customized', $key);

			// like true | false | any id
			if($query_result !== null)
			{
				$have_change = true;
			}
		}

		if($have_change)
		{
			\lib\app\website\generator::remove_catch();
			\dash\notif::ok(T_("Your footer customized"));
		}
		else
		{
			\dash\notif::info(T_("Your website footer saved without change"));
		}

		return true;
	}

}
?>
