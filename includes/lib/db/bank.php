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
				i_banks.card LIKE ('%__string__%') OR
				i_banks.accountnumber LIKE ('%__string__%') OR
				i_banks.shaba LIKE ('%__string__%') OR
				i_banks.branch LIKE ('%__string__%')
			",

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
