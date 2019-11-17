<?php
namespace lib\db\producttag;


class tagusage
{


	public static function insert()
	{
		\dash\db\config::public_insert('producttagusage', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('producttagusage', ...func_get_args());
	}


	public static function update_where()
	{
		return \dash\db\config::public_update_where('producttagusage', ...func_get_args());
	}


	public static function update()
	{
		return \dash\db\config::public_update('producttagusage', ...func_get_args());
	}


	public static function get()
	{
		return \dash\db\config::public_get('producttagusage', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\db\config::public_get_count('producttagusage', ...func_get_args());
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
				producttag.id AS `producttag_id`,
				producttag.title,
				producttag.slug
			FROM
				producttagusage
			INNER JOIN producttag ON producttag.id = producttagusage.producttag_id
			WHERE
				producttagusage.product_id = $_product_id
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
				producttagusage
			SET
				producttagusage.count =
					(
						SELECT COUNT(*) FROM products WHERE products.cat_id = producttagusage.id
					)
			WHERE
				producttagusage.store_id = $_store_id
				$where";

		\dash\db::query($query);
	}


	public static function delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM producttagusage WHERE id = $_id LIMIT 1";
		return \dash\db::query($query);
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[
			'search_field' =>
			"
				producttagusage.title LIKE ('%__string__%') OR
				producttagusage.url LIKE ('%__string__%') OR
				producttagusage.slug LIKE ('%__string__%')
			",

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('producttagusage', $_string, $_option);
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
			FROM producttagusage
			WHERE
				producttagusage.title IN ('$_titles') AND
				producttagusage.type = '$_type'
		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM producttagusage WHERE $where ";
			return \dash\db::query($query);
		}
	}

}
?>
