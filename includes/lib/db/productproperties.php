<?php
namespace lib\db;


class productproperties
{

	public static function insert()
	{
		\dash\db\config::public_insert('productproperties', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('productproperties', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('productproperties', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('productproperties', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('productproperties', ...func_get_args());
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				productproperties.title LIKE ('%__string__%') OR
				productproperties.card LIKE ('%__string__%') OR
				productproperties.accountnumber LIKE ('%__string__%') OR
				productproperties.shaba LIKE ('%__string__%') OR
				productproperties.nameoncard LIKE ('%__string__%') OR
				productproperties.owner LIKE ('%__string__%') OR
				productproperties.branch LIKE ('%__string__%')
			",

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('productproperties', $_string, $_option);
		return $result;
	}

	public static function delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM productproperties WHERE id = $_id LIMIT 1";
		return \dash\db::query($query);
	}

}
?>
