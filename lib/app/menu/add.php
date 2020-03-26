<?php
namespace lib\app\menu;

class add
{

	public static function new_menu($_args)
	{
		$condition =
		[
			'title' => 'string_50',
		];

		$require = ['title'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$slug = \dash\validate::slug($data['title'], false);

		$new_menu_value = ['title' => $data['title'], 'slug' => $slug, 'list' => []];

		$new_menu_value = json_encode($new_menu_value, JSON_UNESCAPED_UNICODE);


		$get = \lib\db\setting\get::platform_cat_key('website', 'menu', $slug);

		if(isset($get['id']))
		{
			\dash\notif::error(T_("This title was exists in your menu list. Try another"));
			return false;
		}

		$insert =
		[
			'platform' => 'website',
			'cat'      => 'menu',
			'key'      => $slug,
			'value'    => $new_menu_value,
		];

		$insert = \lib\db\setting\insert::new_record($insert);

		if($insert)
		{
			\dash\notif::ok(T_("Your menu was saved"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("Oops! We cannot complete your request. Please contact to administrator"));
			return false;
		}

	}
}
?>