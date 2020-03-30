<?php
namespace lib\app\website_footer;

class set
{

	public static function set_footer_template($_args)
	{
		$condition =
		[
			'footer' => ['enum' => array_keys(\lib\app\website_footer\template::list())],
		];

		$require = ['footer'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$save = \lib\db\setting\update::overwirte_platform_cat_key($data['footer'], 'website', 'footer', 'active');

		if($save)
		{
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
		$menu = ['enum' => \lib\app\menu\get::list_all_menu_keys()];
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

			\lib\db\setting\update::overwirte_platform_cat_key($value, 'website', 'footer_customized', 'saved_'. $key);

		}


		\dash\notif::ok(T_("Your footer customized"));
		return true;
	}

}
?>
