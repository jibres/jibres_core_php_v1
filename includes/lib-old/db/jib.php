<?php
namespace lib\db;


class jib
{

	public static function insert()
	{
		\dash\db\config::public_insert('i_jib', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('i_jib', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('i_jib', ...func_get_args());
	}

	public static function update_where()
	{
		return \dash\db\config::public_update_where('i_jib', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('i_jib', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('i_jib', ...func_get_args());
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				i_banks.title LIKE ('%__string__%') OR
				i_jib.title LIKE ('%__string__%')

			",
			'public_show_field' => "i_jib.*, i_banks.title AS `bank_title`",
			'master_join' => "LEFT JOIN i_banks ON i_jib.bank_id = i_banks.id"

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('i_jib', $_string, $_option);
		return $result;
	}

}
?>
