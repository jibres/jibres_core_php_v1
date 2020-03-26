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
		$menu = ['enum' => \lib\app\menu\get::list_all_menu_keys()];
		$condition =
		[
			'header_description' => 'desc',
			'header_menu_1'      => $menu,
			'header_menu_2'      => $menu,
			'logo'               => 'string',
		];

		$require = [];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$save_header = \lib\app\website_header\get::active_header_detail();
		if(!$save_header)
		{
			\dash\notif::error(T_("No active header founded"));
			return false;
		}

		$current_detail = $save_header['current_detail'];

		foreach ($save_header['step'] as $key => $value)
		{
			foreach ($value as $ikey => $ivalue)
			{
				if(isset($ivalue['name']) && $data[$ivalue['name']])
				{
					$current_detail[$ivalue['name']] = $data[$ivalue['name']];
				}
			}
		}

		$current_detail = json_encode($current_detail, JSON_UNESCAPED_UNICODE);
		\lib\db\setting\update::overwirte_platform_cat_key($current_detail, 'website', $save_header['key'], 'customized');

		\dash\notif::ok(T_("Your header customized"));
		return true;
	}

}
?>
