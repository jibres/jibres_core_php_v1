<?php
namespace lib\db\products;

class get
{
	public static function count_group_by_month_fuel($_fuel, $_dbname)
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				CONCAT(YEAR(products.datecreated), '-', MONTH(products.datecreated)) AS `year_month`
			FROM
				products
			GROUP by
				`year_month`
		";

		$result = \dash\pdo::get($query, [], null, false, $_fuel, ['database' => $_dbname]);

		return $result;
	}


	public static function check_duplicate_variants_add($_args)
	{
		$q  = \dash\pdo\prepare_query::generate_where('products', $_args);

		$query  = "SELECT * FROM products WHERE $q[where] LIMIT 1";
		$param  = $q['param'];
		$result = \dash\pdo::get($query, $param, null, true);

		return $result;

	}


	public static function count_added_by_ganje()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.ganje_id IS NOT NULL  ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;

	}


	public static function sitemap_list($_from, $_to)
	{
		$query  =
		"
			SELECT
				products.id,
				products.slug,
				IFNULL(products.datemodified, products.datecreated) AS `datemodified`
			FROM
				products
			WHERE
				products.status = 'active' AND
				products.parent IS NULL AND
				products.id >= $_from AND
				products.id < $_to
		";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function load_family_group_name($_parent_id, $_index)
	{
		$query  =
		"
			SELECT
				products.optionname1,
				products.optionname2,
				products.optionname3,
				products.optionvalue1,
				products.optionvalue2,
				products.optionvalue3
			FROM
				products
			WHERE
				products.parent = $_parent_id AND
				products.status != 'deleted'
		";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function check_all_is_child($_id, $_childs)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.parent = $_id AND products.id IN ($_childs)";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}

	public static function total_fund()
	{
		$query   =
		"
			SELECT
				SUM(myTable.my_finalprice) AS `total_finalprice`,
				SUM(myTable.my_price) AS `total_price`,
				SUM(myTable.my_profit) AS `total_profit`,
				SUM(myTable.my_discount) AS `total_discount`,
				SUM(myTable.my_buyprice) AS `total_buyprice`
			FROM
			(
				SELECT
					@stock := (SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1),
					@stock := IF(@stock < 0 OR @stock IS NULL, 0, @stock),
					(products.finalprice * @stock) AS `my_finalprice`,
					(products.discount * @stock) AS `my_discount`,
					(products.price * @stock) AS `my_price`,
					(products.buyprice * @stock) AS `my_buyprice`,
					((products.finalprice * @stock) - (products.buyprice * @stock)) AS `my_profit`
				FROM
					products
				WHERE
					products.status != 'deleted'
			) AS `myTable`
		";
		$result = \dash\pdo::get($query, [], null, true);

		return $result;
	}

	public static function last_productprice_id($_products_id)
	{
		$query  = "SELECT productprices.id AS `id` FROM productprices WHERE productprices.product_id = $_products_id ORDER BY productprices.id DESC LIMIT 1";
		$result = \dash\pdo::get($query, [], 'id', true);

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
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function bestselling()
	{
		$query   =
		"
			SELECT
				products.*,
				(SELECT SUM(factordetails.count) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_count`
			FROM
				products
			WHERE
				products.status != 'deleted'
			ORDER BY `sold_count`  DESC
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], null, true);
		return $result;

	}

	public static function last_product_in_cart($_limit)
	{

		$query =
		"
			SELECT
				cart.product_id AS `product_id`
			FROM
				cart
			GROUP BY cart.product_id
			ORDER BY MAX(cart.datecreated) DESC
			LIMIT $_limit
		";

		$result = \dash\pdo::get($query, [], 'product_id');


		if($result)
		{
			$ids = implode(',', $result);
			$query =
			"
				SELECT
					products.*
				FROM
					products
				WHERE
					products.id IN ($ids)
			";
			$result = \dash\pdo::get($query);
			return $result;
		}

		return null;
	}


	public static function most_product_in_cart()
	{
		$query =
		"
			SELECT
				cart.product_id AS `product_id`,
				COUNT(*) AS `count`
			FROM
				cart
			GROUP BY cart.product_id
			ORDER BY `count` DESC
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], null, true);


		if($result)
		{
			$query =
			"
				SELECT
					products.*,
					$result[count] AS `count`
				FROM
					products
				WHERE
					products.id  = $result[product_id]
				LIMIT 1
			";
			$result = \dash\pdo::get($query, [], null, true);
			return $result;
		}

		return null;

	}


	public static function max_price_change_count()
	{
		$query =
		"
			SELECT
				productprices.product_id AS `product_id`,
				COUNT(*) AS `count`
			FROM
				productprices
			GROUP BY productprices.product_id
			ORDER BY `count` DESC
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], null, true);


		if($result)
		{
			$query =
			"
				SELECT
					products.*,
					$result[count] AS `count`
				FROM
					products
				WHERE
					products.id  = $result[product_id]
				LIMIT 1
			";
			$result = \dash\pdo::get($query, [], null, true);
			return $result;
		}

		return null;

	}


	public static function have_any_product()
	{
		$query = " SELECT products.id FROM products LIMIT 1";

		$result = \dash\pdo::get($query, [], null, true);

		return $result;
	}


	public static function maxsaleprice()
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.sum) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_price` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_price`  DESC LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function count_have_variants()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM	products WHERE products.variant_child = 1 AND products.status != 'deleted' ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function maxstock()
	{
		$query   =
		"
			SELECT
				products.*,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
			FROM
				products
			WHERE
				products.status != 'deleted'
			ORDER BY `stock`  DESC LIMIT 1
		";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function maxstock_list($_limit)
	{
		$query   =
		"
			SELECT
				products.*,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
			FROM
				products
			WHERE
				products.status != 'deleted'
			ORDER BY `stock`  DESC LIMIT $_limit
		";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function maxsaleprice_list($_limit)
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.sum) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_price` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_price`  DESC LIMIT $_limit";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function maxsale()
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.count) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_count` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_count`  DESC LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function maxsale_list($_limit)
	{
		$query   = "SELECT products.*, (SELECT SUM(factordetails.count) FROM factordetails WHERE factordetails.product_id = products.id) AS `sold_count` FROM products WHERE products.status != 'deleted'  ORDER BY `sold_count`  DESC LIMIT $_limit";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function average_finalprice()
	{
		$query   = "SELECT AVG(products.finalprice) AS `finalprice` FROM products WHERE products.status != 'deleted' ";
		$result = \dash\pdo::get($query, [], 'finalprice', true);
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
		$result = \dash\pdo::get($query, [], null);
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
		$result = \dash\pdo::get($query, [], null);
		return $result;
	}


	public static function inexpensive()
	{
		$query   = "SELECT * FROM products WHERE products.status != 'deleted' AND products.finalprice != 0 AND products.finalprice IS NOT NULL ORDER BY products.finalprice ASC LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}



	public static function variant_min_max_price($_id)
	{
		$query  = "SELECT MIN(products.finalprice) AS `min_price`, MAX(products.finalprice) AS `max_price` FROM products WHERE products.status != 'deleted' AND products.parent = $_id ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function check_duplicate_title($_title, $_id)
	{
		$query  = "SELECT * FROM products WHERE products.status != 'deleted' AND products.title = '$_title' AND products.id != $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function export_list($_start_limit, $_end_limit)
	{
		$query  = "SELECT * FROM products WHERE products.status != 'deleted' ORDER BY products.id ASC LIMIT $_start_limit, $_end_limit";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function all_record_for_export()
	{
		$query  = "SELECT * FROM products WHERE products.status != 'deleted' ORDER BY products.id ASC ";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function first_product_id()
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.status != 'deleted' ORDER BY products.id ASC LIMIT 1 ";
		$result = \dash\pdo::get($query, [], 'id', true);
		return $result;
	}


	public static function end_product_id()
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.status != 'deleted' ORDER BY products.id DESC LIMIT 1 ";
		$result = \dash\pdo::get($query, [], 'id', true);
		return $result;
	}



	public static function check_import_id($_ids)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.id IN ($_ids) ";
		$result = \dash\pdo::get($query, [], 'id');
		return $result;
	}


	public static function count_all_for_dashboard()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM products WHERE products.status NOT IN ('deleted', 'archive') AND products.parent IS NULL ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}



	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM products WHERE products.status != 'deleted' ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function prev($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.id = (SELECT MAX(products.id) FROM products WHERE products.status NOT IN ('deleted', 'archive') AND products.parent IS NULL AND products.id < $_id) LIMIT 1 ";
		$result = \dash\pdo::get($query, [], 'id', true);
		return $result;
	}

	public static function next($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.id = (SELECT MIN(products.id) FROM products WHERE products.status NOT IN ('deleted', 'archive') AND products.parent IS NULL AND products.id > $_id) LIMIT 1 ";
		$result = \dash\pdo::get($query, [], 'id', true);
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
		$result = \dash\pdo::get($query);
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
		$result = \dash\pdo::get($query, [], null, true);
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
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}





	public static function by_id_for_site($_id)
	{
		$query  =
		"
			SELECT
				products.*,
				-- (IF(products.thumb IS NULL AND products.parent IS NOT NULL, (SELECT pProduct.thumb FROM products AS pProduct WHERE pProduct.id = products.parent LIMIT 1), products.thumb)) AS `thumb`,
				-- (IF(products.gallery IS NULL AND products.parent IS NOT NULL, (SELECT pProduct.gallery FROM products AS pProduct WHERE pProduct.id = products.parent LIMIT 1), products.gallery)) AS `gallery`,
				IF(products.parent IS NOT NULL , parentProduct.thumb, products.thumb)  as `thumb`,
				IF(products.parent IS NOT NULL , parentProduct.gallery, products.gallery)  as `gallery`,
				IF(products.parent IS NOT NULL , parentProduct.preparationtime, products.preparationtime)  as `preparationtime`,
				IF(products.parent IS NOT NULL , parentProduct.preparationtime, products.preparationtime)  as `preparationtime`,
				IF(products.parent IS NOT NULL , parentProduct.oversale, products.oversale)  as `oversale`,
				IF(products.parent IS NOT NULL , parentProduct.title2, products.title2) AS `title2`,
				IF(products.parent IS NOT NULL , parentProduct.seotitle, products.seotitle) AS `seotitle`,
				IF(products.parent IS NOT NULL , parentProduct.seodesc, products.seodesc) AS `seodesc`,
				IF(products.parent IS NOT NULL , parentProduct.`desc`, products.`desc`) AS `desc`,
				IF(products.parent IS NOT NULL , parentProduct.salestep, products.salestep) AS `salestep`,
				IF(products.parent IS NOT NULL , parentProduct.minsale, products.minsale) AS `minsale`,
				IF(products.parent IS NOT NULL , parentProduct.maxsale, products.maxsale) AS `maxsale`,
				IF(products.parent IS NOT NULL , parentProduct.scalecode, products.scalecode) AS `scalecode`,
				IF(products.parent IS NOT NULL , parentProduct.weight, products.weight) AS `weight`,
				IF(products.parent IS NOT NULL , parentProduct.length, products.length) AS `length`,
				IF(products.parent IS NOT NULL , parentProduct.width, products.width) AS `width`,
				IF(products.parent IS NOT NULL , parentProduct.height, products.height) AS `height`,
				IF(products.parent IS NOT NULL , parentProduct.status, products.status) AS `status`,
				IF(products.parent IS NOT NULL , parentProduct.vat, products.vat) AS `vat`,
				IF(products.parent IS NOT NULL , parentProduct.trackquantity, products.trackquantity) AS `trackquantity`,
				IF(products.parent IS NOT NULL , parentProduct.saleonline, products.saleonline) AS `saleonline`,
				IF(products.parent IS NOT NULL , parentProduct.saletelegram, products.saletelegram) AS `saletelegram`,
				IF(products.parent IS NOT NULL , parentProduct.saleapp, products.saleapp) AS `saleapp`,
				IF(products.parent IS NOT NULL , parentProduct.minstock, products.minstock) AS `minstock`,
				IF(products.parent IS NOT NULL , parentProduct.maxstock, products.maxstock) AS `maxstock`,
				        
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
  			FROM
				products
  			LEFT JOIN products AS `parentProduct` ON parentProduct.id = products.parent
			WHERE
				products.id = :id
			LIMIT 1
		";
		$param = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}




	public static function by_barcode_for_site($_barcode)
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
				products.barcode = :barcode OR products.barcode2 = :2barcode
			LIMIT 1
		";
		$param = [':barcode' => $_barcode, ':2barcode' => $_barcode];

		$result = \dash\pdo::get($query, $param, null, true);
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

		$result = \dash\pdo::get($query, [], null, true);

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
				products.*,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`
			FROM products
			WHERE products.id IN ($_ids)
		";
		$result = \dash\pdo::get($query);
		return $result;
	}


	/**
	 * Get ids as array and bidn query
	 *
	 * @param      <type>  $_ids   The identifiers
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function by_multi_id_array(array $_ids)
	{
		$ids = implode(',', $_ids);
		$query  =
		"
			SELECT
				products.*
			FROM products
			WHERE products.id IN ($ids)
		";
		$param = [];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}


	public static function some_field_by_multi_id($_ids, $_fields)
	{
		$query  = " SELECT $_fields FROM products WHERE products.id IN ($_ids) ";
		$result = \dash\pdo::get($query);
		return $result;
	}



	public static function check_unique_sku($_sku)
	{
		$query = "SELECT `id`, `sku` FROM products WHERE products.sku = '$_sku' AND products.status  != 'deleted' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function one($_id)
	{
		$query  = "SELECT * FROM products WHERE products.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function variants_have_child($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.parent = $_id AND products.status != 'deleted' LIMIT 1";
		$result = \dash\pdo::get($query, [], 'id', true);
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
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function variants_load_family($_id, $_parent_id)
	{
		$query  = "SELECT * FROM products WHERE ((products.parent = $_parent_id) OR products.id = $_parent_id) AND products.status != 'deleted' ORDER BY products.id ASC ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function variants_load_max_value($_ids)
	{
		$query  =
		"
			SELECT
				MAX(products.id) AS `id`,
				products.parent,
				MAX(products.slug) AS `slug`,
				MAX(products.price) AS `price`,
				MAX(products.finalprice) AS `finalprice`,
				MAX(products.discount) AS `discount`,
				MAX(products.discountpercent) AS `discountpercent`
			FROM
				products
			WHERE
				products.parent IN ($_ids) AND
				products.finalprice = (SELECT MAX(min_products.finalprice) FROM products AS `min_products` WHERE min_products.parent = products.parent AND min_products.status != 'deleted')
			GROUP BY products.parent
		";

		$result = \dash\pdo::get($query);

		return $result;
	}


	public static function variants_load_min_value($_ids)
	{
		$query  =
		"
			SELECT
				MIN(products.id) AS `id`,
				products.parent,
				MIN(products.slug) AS `slug`,
				MIN(products.price) AS `price`,
				MIN(products.finalprice) AS `finalprice`,
				MIN(products.discount) AS `discount`,
				MIN(products.discountpercent) AS `discountpercent`
			FROM
				products
			WHERE
				products.parent IN ($_ids) AND
				products.finalprice = (SELECT MIN(min_products.finalprice) FROM products AS `min_products` WHERE min_products.parent = products.parent AND min_products.status != 'deleted')
			GROUP BY products.parent
		";

		$result = \dash\pdo::get($query);

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
		$result = \dash\pdo::get($query);

		return $result;
	}







	public static function website_last_product($_and, $_or, $_order, $_meta)
	{
		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order, $_meta);
		$query  = " SELECT products.* FROM products $q[join] $q[where] ORDER BY $q[order] LIMIT $q[limit]";
		$result = \dash\pdo::get($query);

		return $result;
	}

}
?>