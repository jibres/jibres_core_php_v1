<?php
namespace lib\db;


class inout
{

	public static function insert()
	{
		\dash\db\config::public_insert('i_inout', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('i_inout', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('i_inout', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('i_inout', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('i_inout', ...func_get_args());
	}


	public static function search($_string = null, $_option = [])
	{
		$number = '';
		if(is_numeric($_string))
		{
			$number = " OR i_inout.plus = '__string__' OR i_inout.minus = '__string__' OR i_inout.discount = '__string__' ";
		}
		$default =
		[
			'search_field' =>
			"
				i_inout.desc LIKE ('%__string__%') OR
				i_inout.thirdparty LIKE ('%__string__%') OR
				i_jib.title LIKE ('%__string__%') OR
				i_cat.title LIKE ('%__string__%')
				$number

			",
			'public_show_field' =>
			"
				i_inout.*,
				i_jib.title AS `jib_title`,
				i_cat.title AS `cat_title`
			",
			"master_join" =>
			"
				INNER JOIN i_jib ON i_jib.id = i_inout.jib_id
				INNER JOIN i_cat ON i_cat.id = i_inout.cat_id
			",

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('i_inout', $_string, $_option);
		return $result;
	}

}
?>
