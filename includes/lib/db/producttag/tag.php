<?php
namespace lib\db\producttag;


class tag
{

	public static function insert()
	{
		\dash\db\config::public_insert('producttag', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('producttag', ...func_get_args());
	}


	public static function update_where()
	{
		return \dash\db\config::public_update_where('producttag', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('producttag', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('producttag', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('producttag', ...func_get_args());
	}


	public static function update_count($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$where = "WHERE $where";
		}

		$query =
		"
			UPDATE
				producttag
			SET
				producttag.count =
					(
						SELECT COUNT(*) FROM products WHERE products.cat_id = producttag.id
					)
				$where
		";

		\dash\db::query($query);
	}


	public static function delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM producttag WHERE id = $_id LIMIT 1";
		return \dash\db::query($query);
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				producttag.title LIKE ('%__string__%') OR
				producttag.url LIKE ('%__string__%') OR
				producttag.slug LIKE ('%__string__%')
			",

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('producttag', $_string, $_option);
		return $result;
	}


	public static function get_mulit_title($_titles)
	{
		if(!is_array($_titles) || !$_titles)
		{
			return false;
		}

		$_titles = implode("','", $_titles);

		$query =
		"
			SELECT *
			FROM producttag
			WHERE
				producttag.title IN ('$_titles')
		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM producttag WHERE $where ";
			return \dash\db::query($query);
		}
	}

	public static function check_multi_id($_ids, $_type)
	{
		if(!is_array($_ids) || !$_type || !$_ids || !$_ids)
		{
			return false;
		}

		$_ids = implode(',', $_ids);

		$query =
		"
			SELECT *
			FROM producttag
			WHERE
				producttag.id IN ($_ids) AND
				producttag.type = '$_type'
		";
		$result = \dash\db::get($query);

		return $result;

	}

}
?>
