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
			\dash\log::oops('db');
			return false;
		}

	}


	public static function menu_item($_args, $_id)
	{
		$condition =
		[
			'title'  => 'string_50',
			'url'    => 'url',
			'target' => 'bit',
		];

		$require = ['title', 'url'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid menu id"));
			return false;
		}

		$load = \lib\db\setting\get::by_id($id);
		if(!$load || !isset($load['value']) || !isset($load['id']))
		{
			\dash\notif::error(T_("Menu detail not found"));
			return false;
		}

		$load_detail = json_decode($load['value'], true);

		if(!isset($load_detail['list']))
		{
			$load_detail['list'] = [];
		}

		$load_detail['list'][] =
		[
			'title'  => $data['title'],
			'url'    => $data['url'],
			'target' => $data['target'],
		];


		$new_detail = json_encode($load_detail, JSON_UNESCAPED_UNICODE);

		$result = \lib\db\setting\update::value($new_detail, $load['id']);

		if($result)
		{
			\dash\notif::ok(T_("Your item added to your menu"));
			return true;
		}
		else
		{
			\dash\log::oops('db');
			return false;
		}

	}
}
?>