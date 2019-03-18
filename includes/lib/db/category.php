<?php
namespace lib\db;


class category
{

	public static function insert()
	{
		\dash\db\config::public_insert('i_cat', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('i_cat', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('i_cat', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('i_cat', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('i_cat', ...func_get_args());
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				i_cat.title LIKE ('%__string__%')
			",
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('i_cat', $_string, $_option);
		return $result;
	}

}
?>
