<?php
namespace lib\db;


class productterms
{

	public static function insert()
	{
		\dash\db\config::public_insert('productterms', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('productterms', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('productterms', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('productterms', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('productterms', ...func_get_args());
	}


	public static function update_count($_store_id, $_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$where = "AND $where";
		}

		$query =
		"
			UPDATE
				productterms
			SET
				productterms.count =
					(
						SELECT COUNT(*) FROM products WHERE products.cat_id = productterms.id
					)
			WHERE
				productterms.store_id = $_store_id
				$where";

		\dash\db::query($query);
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				productterms.title LIKE ('%__string__%') OR
				productterms.url LIKE ('%__string__%') OR
				productterms.slug LIKE ('%__string__%')
			",

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('productterms', $_string, $_option);
		return $result;
	}

}
?>
