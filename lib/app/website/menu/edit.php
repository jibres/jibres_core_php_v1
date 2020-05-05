<?php
namespace lib\app\website\menu;

class edit
{

	public static function edit_menu($_args, $_id)
	{
		$id   = \dash\validate::code($_id);
		$id   = \dash\coding::decode($id);
		$load = \lib\app\website\menu\get::load_menu_by_id($id, false);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid menu id"));
			return false;
		}

		$condition =
		[
			'title' => 'string_50',
		];

		$require = ['title'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$menu_detail = [];
		if(isset($load['value']) && is_string($load['value']))
		{
			$menu_detail = json_decode($load['value'], true);
		}

		if(!isset($menu_detail['title']))
		{
			\dash\notif::error(T_("Invalid menu detail"));
			return false;
		}

		$menu_detail['title'] = $data['title'];

		$result = \lib\db\setting\update::value(json_encode($menu_detail, JSON_UNESCAPED_UNICODE), $id);



		if($result)
		{
			\dash\file::delete(\dash\engine\store::website_addr(). \lib\store::id());

			\dash\notif::ok(T_("Menu was updated"));
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