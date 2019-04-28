<?php
namespace lib\db;


class producttermusages
{


	public static function insert()
	{
		\dash\db\config::public_insert('producttermusages', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('producttermusages', ...func_get_args());
	}


	public static function update_where()
	{
		return \dash\db\config::public_update_where('producttermusages', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('producttermusages', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('producttermusages', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('producttermusages', ...func_get_args());
	}


	public static function usage($_product_id)
	{
		if(!$_product_id)
		{
			return false;
		}

		$query =
		"
			SELECT
				productterms.id AS `productterm_id`,
				productterms.*
			FROM
				producttermusages
			INNER JOIN productterms ON productterms.id = producttermusages.productterm_id
			WHERE
				producttermusages.product_id = $_product_id
		";
		$result = \dash\db::get($query);
		return $result;
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
				producttermusages
			SET
				producttermusages.count =
					(
						SELECT COUNT(*) FROM products WHERE products.cat_id = producttermusages.id
					)
			WHERE
				producttermusages.store_id = $_store_id
				$where";

		\dash\db::query($query);
	}


	public static function delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM producttermusages WHERE id = $_id LIMIT 1";
		return \dash\db::query($query);
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				producttermusages.title LIKE ('%__string__%') OR
				producttermusages.url LIKE ('%__string__%') OR
				producttermusages.slug LIKE ('%__string__%')
			",

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('producttermusages', $_string, $_option);
		return $result;
	}


	public static function get_mulit_term_title($_titles, $_type)
	{
		if(!is_array($_titles) || !$_type || !$_titles)
		{
			return false;
		}

		$_titles = implode("','", $_titles);

		$query =
		"
			SELECT *
			FROM producttermusages
			WHERE
				producttermusages.title IN ('$_titles') AND
				producttermusages.type = '$_type'
		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM producttermusages WHERE $where ";
			return \dash\db::query($query);
		}
	}

}
?>
