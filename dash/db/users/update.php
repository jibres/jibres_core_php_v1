<?php
namespace dash\db\users;


class update
{
	public static function jibres_password($_password, $_user_id)
	{
		$query  = "UPDATE users SET users.password = '$_password' WHERE users.id = $_user_id LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}


	public static function jibres_password_in_other_store($_password, $_jibres_user_id, $_current_store_id)
	{
		$query  =
		"
			SELECT
				store.fuel AS `fuel`,
				store.id AS `id`
			FROM
				store
			INNER JOIN store_user ON store_user.store_id = store.id
			WHERE
				store_user.user_id = $_jibres_user_id AND
				store.id != $_current_store_id
		";

		$result = \dash\db::get($query, null, false, 'master');

		if($result)
		{
			foreach ($result as $key => $myFuel)
			{
				$database_name = \dash\engine\store::make_database_name($myFuel['id']);
				$query  = "UPDATE users SET users.password = '$_password' WHERE users.jibres_user_id = $_jibres_user_id LIMIT 1 -- $myFuel[fuel] $database_name ";
				\dash\db::query($query, $myFuel['fuel'], ['database' => $database_name]);
			}
		}
	}



	public static function jibres_password_in_all_store($_password, $_user_id)
	{
		$query  =
		"
			SELECT
				store.fuel AS `fuel`,
				store.id AS `id`
			FROM
				store
			INNER JOIN store_user ON store_user.store_id = store.id
			WHERE
				store_user.user_id = $_user_id
		";

		$result = \dash\db::get($query, null, false, 'master');

		if($result)
		{
			foreach ($result as $key => $myFuel)
			{
				$database_name = \dash\engine\store::make_database_name($myFuel['id']);
				$query  = "UPDATE users SET users.password = '$_password' WHERE users.jibres_user_id = $_user_id LIMIT 1 -- $myFuel[fuel] $database_name ";
				\dash\db::query($query, $myFuel['fuel'], ['database' => $database_name]);
			}
		}
	}

}
?>