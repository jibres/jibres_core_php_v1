<?php
namespace lib\db;


class bank
{

	public static function insert()
	{
		\dash\db\config::public_insert('i_banks', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('i_banks', ...func_get_args());
	}

	public static function myList($_user_id)
	{
		$query =
		"
			SELECT
				GROUP_CONCAT(DISTINCT i_banks.title) AS `title`,
				GROUP_CONCAT(DISTINCT i_banks.subtitle) AS `subtitle`,
				GROUP_CONCAT(DISTINCT i_banks.cat) AS `cat`,
				GROUP_CONCAT(DISTINCT i_banks.cat2) AS `cat2`,
				GROUP_CONCAT(DISTINCT i_banks.size) AS `size`
			FROM
				i_banks
			WHERE i_banks.user_id = $_user_id
		";
		$result = \dash\db::get($query, null , true);
		return $result;
	}


	public static function update()
	{
		return \dash\db\config::public_update('i_banks', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('i_banks', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('i_banks', ...func_get_args());
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				i_banks.title LIKE ('%__string__%') OR
				i_banks.subtitle LIKE ('%__string__%') OR
				i_banks.cat LIKE ('%__string__%') OR
				i_banks.cat2 LIKE ('%__string__%') OR
				i_banks.size LIKE ('%__string__%')
			",
			'public_show_field' => "i_banks.*, users.displayname, users.avatar",
			'master_join' => "INNER JOIN users ON users.id = i_banks.user_id"
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('i_banks', $_string, $_option);
		return $result;
	}

}
?>
