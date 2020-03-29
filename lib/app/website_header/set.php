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


		$logo = \dash\upload\store_logo::website_logo();

		if($logo)
		{
			$get_logo = \lib\db\setting\get::platform_cat_key('website', 'header_logo', 'file');

			$have_change = false;

			$logo_setting_id = null;
			if(isset($get_logo['id']))
			{
				$logo_setting_id = $get_logo['id'];

				if(isset($get_logo['value']) && $get_logo['value'] === $logo)
				{
					\dash\notif::info(T_("You website logo saved without change"));
				}
				else
				{
					$have_change = true;
					\lib\db\setting\update::value($logo, $get_logo['id']);
				}
			}
			else
			{
				$insert =
				[
					'platform' => 'website',
					'cat'      => 'header_logo',
					'key'      => 'file',
					'value'    => $logo,
				];

				$have_change = true;
				$logo_setting_id = \lib\db\setting\insert::new_record($insert);
			}


			if($have_change)
			{
				// \dash\notif::ok(T_("Your website logo was saved"));
			}

			if($logo_setting_id)
			{
				$current_detail['website_header_logo_setting_id'] = $logo_setting_id;
			}

		}




		$current_detail = json_encode($current_detail, JSON_UNESCAPED_UNICODE);
		\lib\db\setting\update::overwirte_platform_cat_key($current_detail, 'website', $save_header['key'], 'customized');

		\dash\notif::ok(T_("Your header customized"));
		return true;
	}

}
?>
