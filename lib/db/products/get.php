<?php
namespace lib\db\products;

class get
{

	public static function last_productprice_id($_products_id)
	{
		$query  = "SELECT productprices.id AS `id` FROM productprices WHERE productprices.product_id = $_products_id ORDER BY productprices.id DESC LIMIT 1";
		$result = \dash\db::get($query, 'id', true);

		if(!is_numeric($result))
		{
			return null;
		}
		else
		{
			return floatval($result);
		}
	}

	public static function expensive()
	{
		$query   = "SELECT * FROM products WHERE products.status != 'deleted' ORDER BY products.finalprice DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function maxsaleprice()
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.sum) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_price` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_price`  DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function maxsaleprice_list($_limit)
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.sum) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_price` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_price`  DESC LIMIT $_limit";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function maxsale()
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.count) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_count` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_count`  DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function maxsale_list($_limit)
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.count) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_count` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_count`  DESC LIMIT $_limit";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function average_finalprice()
	{
		$query   = "SELECT AVG(products.finalprice) AS `finalprice` FROM products WHERE products.status != 'deleted' ";
		$result = \dash\db::get($query, 'finalprice', true);
		return $result;
	}



	public static function expensive_list($_limit)
	{
		$query   =
		"
			SELECT
				products.*
			FROM
				products
			WHERE
				products.status != 'deleted'
			ORDER BY products.finalprice DESC
			LIMIT $_limit
		";
		$result = \dash\db::get($query, null);
		return $result;
	}

	public static function inexpensive_list($_limit)
	{
		$query   =
		"
			SELECT
				products.*
			FROM
				products
			WHERE
				products.status != 'deleted' AND
				products.finalprice != 0 AND
				products.finalprice IS NOT NULL
			ORDER BY products.finalprice ASC
			LIMIT $_limit
		";
		$result = \dash\db::get($query, null);
		return $result;
	}


	public static function inexpensive()
	{
		$query   = "SELECT * FROM products WHERE products.status != 'deleted' AND products.finalprice != 0 AND products.finalprice IS NOT NULL ORDER BY products.finalprice ASC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function variant_min_max_price($_id)
	{
		$query  = "SELECT MIN(products.finalprice) AS `min_price`, MAX(products.finalprice) AS `max_price` FROM products WHERE products.status != 'deleted' AND products.parent = $_id ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_duplicate_title($_title, $_id)
	{
		$query  = "SELECT * FROM products WHERE products.status != 'deleted' AND products.title = '$_title' AND products.id != $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function export_list($_start_limit, $_end_limit)
	{
		$query  = "SELECT * FROM products WHERE products.status != 'deleted' ORDER BY products.id ASC LIMIT $_start_limit, $_end_limit";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function all_record_for_export()
	{
		$query  = "SELECT * FROM products WHERE products.status != 'deleted' ORDER BY products.id ASC ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function first_product_id()
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.status != 'deleted' ORDER BY products.id ASC LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	public static function end_product_id()
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.status != 'deleted' ORDER BY products.id DESC LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}



	public static function check_import_id($_ids)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.id IN ($_ids) ";
		$result = \dash\db::get($query, 'id');
		return $result;
	}





	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM products WHERE products.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function prev($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.id = (SELECT MAX(products.id) FROM products WHERE products.status != 'deleted' AND products.id < $_id) LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}

	public static function next($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.id = (SELECT MIN(products.id) FROM products WHERE products.status != 'deleted' AND products.id > $_id) LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}



	public static function barcode($_barcode)
	{
		$query =
		"
			SELECT
				`id`,
				`title`,
				`barcode`,
				`barcode2`
			FROM
			 	products
			WHERE
				products.status  != 'deleted' AND
				(products.barcode = '$_barcode' OR products.barcode2 = '$_barcode')
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_barcode($_barcode)
	{
		$query  =
		"
			SELECT
				*
			FROM
				products
			WHERE
				products.status  != 'deleted' AND
				(products.barcode = '$_barcode' OR products.barcode2 = '$_barcode')
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function scalecode($_scalecode)
	{
		$query  =
		"
			SELECT
				*
			FROM
				products
			WHERE
				products.status  != 'deleted' AND
				products.scalecode = '$_scalecode'
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function one_field($_id, $_field)
	{
		$query  = "SELECT products.$_field FROM products WHERE products.id = $_id  LIMIT 1";
		$result = \dash\db::get($query, $_field, true);
		return $result;
	}




	public static function by_id_for_site($_id)
	{
		$query  =
		"
			SELECT
				products.*,
				(IF(products.thumb IS NULL AND products.parent IS NOT NULL, (SELECT pProduct.thumb FROM products AS pProduct WHERE pProduct.id = products.parent LIMIT 1), products.thumb)) AS `thumb`,
				(IF(products.gallery IS NULL AND products.parent IS NOT NULL, (SELECT pProduct.gallery FROM products AS pProduct WHERE pProduct.id = products.parent LIMIT 1), products.gallery)) AS `gallery`,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
  			FROM
				products
			WHERE
				products.id = $_id
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_id($_id)
	{
		$query  =
		"
			SELECT
				products.*,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
  			FROM
				products
			WHERE
				products.id = $_id
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	/**
	 * Get multi product by id
	 * Call in factor add to check multi product and add new factor
	 *
	 * @param      <type>  $_ids   The identifiers
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function by_multi_id($_ids)
	{
		$query  =
		"
			SELECT
				products.*
			FROM products
			WHERE products.id IN ($_ids)
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function some_field_by_multi_id($_ids, $_fields)
	{
		$query  = " SELECT $_fields FROM products WHERE products.id IN ($_ids) ";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function check_unique_sku($_sku)
	{
		$query = "SELECT `id`, `sku` FROM products WHERE products.sku = '$_sku' AND products.status  != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function one($_id)
	{
		$query  = "SELECT * FROM products WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function duplicate_id()
	{
		$query =
		"
			SELECT
				products.id
			FROM
				products
			INNER JOIN
				(
					SELECT
						title
					FROM
						products
					GROUP BY title
					HAVING COUNT(*) > 1
				) dup
			   ON products.title = dup.title
		";
		$result = \dash\db::get($query, 'id');

		return $result;
	}



	public static function variants_have_child($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.parent = $_id AND products.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	public static function variants_load_child($_id)
	{
		$query  =
		"
			SELECT
				products.*,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
			FROM
				products
			WHERE
				products.parent = $_id AND
				products.status != 'deleted'
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function variants_load_family($_id, $_parent_id)
	{
		$query  = "SELECT * FROM products WHERE ((products.parent = $_parent_id) OR products.id = $_parent_id) AND products.status != 'deleted' ORDER BY products.id ASC ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function variants_load_child_count($_products_ids)
	{
		$query  =
		"
			SELECT
				products.parent,
				COUNT(*) AS `count`,
				MIN(products.finalprice) AS `min_price`,
				MAX(products.finalprice) AS `max_price`
			FROM
				products
			WHERE
				products.parent IN ($_products_ids) AND
				products.status != 'deleted'
			GROUP BY products.parent
		";
		$result = \dash\db::get($query);

		return $result;
	}







	public static function website_last_product($_and, $_or, $_order, $_meta)
	{
		$q = \lib\db\products\search::ready_to_sql($_and, $_or, $_order, $_meta);


		$query  = " SELECT products.* FROM products $q[join] $q[where] ORDER BY $q[order] LIMIT $q[limit]";
		$result = \dash\db::get($query);

		return $result;
	}

}
?>