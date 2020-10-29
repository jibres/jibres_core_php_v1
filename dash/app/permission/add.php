<?php
namespace dash\app\permission;


class add
{

	public static function add($_args)
	{
		$condition =
		[
			'title'      => 'title',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(mb_strtolower($data['title']) === 'admin' || mb_strtolower($data['title']) === 'supervisor' || strpos(mb_strtolower($data['title']), 'supervisor') !== false)
		{
			\dash\notif::error(T_("Can not choose this name in permission title, Try another title"), 'title');
			return false;
		}


		$check_duplicate = \lib\db\setting\get::by_cat_key('permission', $data['title']);
		if(isset($check_duplicate['id']))
		{
			\dash\notif::error(T_("This permission title is already exists in your list, Try another title"), 'title');
			return false;
		}

		$check_count = \lib\db\setting\get::count_by_cat('permission');

		if(floatval($check_count) > 50)
		{
			\dash\notif::error(T_("You have used the maximum capacity to define permission"));
			return false;
		}

		$insert =
		[
			'cat'   => 'permission',
			'key'   => $data['title'],
			'value' => null,
		];


		$setting_id = \lib\db\setting\insert::new_record($insert);

		if(!$setting_id)
		{
			\dash\log::oops('insertPermissionDbError');
			return false;
		}

		$result       = [];
		$result['id'] = $setting_id;
		return $result;

	}
}
?>