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


	public static function search($_string = null, $_args = [])
	{
		$default =
		[
			'search_field' => " ( title LIKE '%__string__%') ",
			'public_show_field' => "i_cat.*, (SELECT myCat.title from i_cat AS `myCat` WHERE myCat.id = i_cat.parent1 LIMIT 1 ) AS `parent_title`",
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default, $_args);

		$result = \dash\db\config::public_search('i_cat', $_string, $_args);
		return $result;
	}

}
?>
