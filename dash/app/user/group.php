<?php
namespace dash\app\user;


class group
{

	public static function list()
	{
		$list = [];

		$list['all_users'] =
		[
			'key'   => 'all_users',
			'title' => T_("All users"),
		];

		$list['users_have_order'] =
		[
			'key'   => 'users_have_order',
			'title' => T_("Users have order"),
		];

		$list['users_havenot_order'] =
		[
			'key'   => 'users_havenot_order',
			'title' => T_("Users have not order"),
		];


		return $list;

	}




	public static function get($_key)
	{
		$list = self::list();
		if(isset($list[$_key]))
		{
			return $list[$_key];
		}
		return null;
	}


	public static function check_input()
	{
		$list = self::list();
		$key = array_column($list, 'key');
		return ['enum' => $key];
	}
}
?>