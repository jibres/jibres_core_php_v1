<?php
namespace lib\db;

class planhistory
{

	public static function insert()
	{
		\dash\db\config::public_insert('planhistory', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function update()
	{
		return \dash\db\config::public_update('planhistory', ...func_get_args());
	}


	public static function get_count()
	{
		return \dash\db\config::public_get_count('planhistory', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('planhistory', ...func_get_args());
	}


	public static function search($_string = null, $_option = [])
	{
		$default_option =
		[
			'search_field' =>
			"
				(
					planhistory.plan LIKE '%__string__%'
				)
			",
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		return \dash\db\config::public_search('planhistory', $_string, $_option);
	}
}
?>