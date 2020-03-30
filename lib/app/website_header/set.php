<?php
namespace lib\app\website_header;

class set
{

	public static function set_header_template($_args)
	{
		$condition =
		[
			'header' => ['enum' => array_keys(\lib\app\website_header\template::list())],
		];

		$require = ['header'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$save = \lib\db\setting\update::overwirte_platform_cat_key($data['header'], 'website', 'header', 'active');

		if($save)
		{
			\dash\notif::ok(T_("Your header was saved"));
			return true;
		}
		else
		{
			\dash\log::oops('db');
			return false;
		}
	}


	public static function customize_header($_args)
	{
		$menu = ['enum' => \lib\app\website_menu\get::list_all_menu_keys()];
		$condition =
		[
			'header_menu_1' => $menu,
			'header_menu_2' => $menu,
			'header_logo'   => 'string',
		];

		$require = [];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$need_save = \dash\cleanse::patch_mode($_args, $data);

		foreach ($need_save as $key => $value)
		{

			if($key === 'header_logo')
			{
				$logo = \dash\upload\store_logo::website_logo();

				if($logo)
				{
					$value = $logo;
				}
			}

			\lib\db\setting\update::overwirte_platform_cat_key($value, 'website', 'header_customized', $key);

		}


		\dash\notif::ok(T_("Your header customized"));
		return true;
	}

}
?>
