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
		$condition =
		[
			'description' => 'desc',
			'menu'        => ['enum' => \lib\app\menu\get::list_all_menu_keys()],
		];

		$require = [];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$save_header = \lib\app\website_header\get::active_header_detail();

		\dash\notif::info("not ready");


	}

}
?>
