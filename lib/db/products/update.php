<?php
namespace lib\db\products;

/**
 * This class describes an update.
 *
 * @author Reza
 * All function of this class converted to PDO binded query
 * @date 2022-01-01 13:49:09
 */
class update
{

	public static function ganje_lastfetch($_id) : void
	{
		$query = "UPDATE products SET products.ganje_lastfetch = :ganje_lastfetch WHERE products.id = :id LIMIT 1 ";
		$param =
		[
			':ganje_lastfetch' => date("Y-m-d H:i:s"),
			':id'              => $_id,
		];

		\dash\pdo::query($query, $param);
	}


	public static function update_desc($_desc, $_id)
	{
		if(\dash\str::strpos($_desc, '\\') !== false)
		{
			// Un-quote string quoted with addcslashes()
			$_desc = stripcslashes($_desc);
		}

		$query = "UPDATE products SET products.desc = :desc WHERE products.id = :id LIMIT 1 ";
		$param =
		[
			':desc' => $_desc,
			':id'   => $_id,
		];

		$result = \dash\pdo::query($query, $param);

		return $result;

	}


	// UPDATE VARIANTS FIELD
	public static function variants($_variants, $_id)
	{
		$query  = "UPDATE products SET products.variants = :variants WHERE products.id = :id LIMIT 1";

		$param =
		[
			':variants' => $_variants,
			':id'       => $_id,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function edit_option($_args, $_parent)
	{

		$q      = \dash\pdo\prepare_query::generate_set('products', $_args);

		$query  = "UPDATE `products` SET $q[set] WHERE products.parent = :parent";

		$param  = array_merge($q['param'], [':parent' => $_parent]);

		$result = \dash\pdo::query($query, $param);

		return $result;

	}


	public static function variant_child($_id)
	{
		$query  = "UPDATE products SET products.variant_child = 1 WHERE products.id = :id LIMIT 1";

		$param =
		[
			':id'       => $_id,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}

	public static function set_status_deleted_variant_option($_optionname, $_optionvalue, $_parent, $_i)
	{
		$query  =
		"
			UPDATE products
			SET products.status = 'deleted'
			WHERE products.parent = :parent AND
			(
				(products.optionname1 = :optionname AND products.optionvalue1 = :optionvalue) OR
				(products.optionname2 = :optionname AND products.optionvalue2 = :optionvalue) OR
				(products.optionname3 = :optionname AND products.optionvalue3 = :optionvalue)
			)
		";


		$param =
		[
			':parent'      => $_parent,
			':optionname'  => $_optionname,
			':optionvalue' => $_optionvalue,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}

	public static function set_null_variant_option($_optionname, $_optionvalue, $_parent, $_i)
	{
		$query  =
		"
			UPDATE products SET products.optionname1 = NULL, products.optionvalue1 = NULL WHERE products.parent = :parent  AND products.optionname1 = :optionname AND products.optionvalue1 = :optionvalue ;
			UPDATE products SET products.optionname2 = NULL, products.optionvalue2 = NULL WHERE products.parent = :parent  AND products.optionname2 = :optionname AND products.optionvalue2 = :optionvalue ;
			UPDATE products SET products.optionname3 = NULL, products.optionvalue3 = NULL WHERE products.parent = :parent  AND products.optionname3 = :optionname AND products.optionvalue3 = :optionvalue ;
		";

		$param =
		[
			':parent'      => $_parent,
			':optionname'  => $_optionname,
			':optionvalue' => $_optionvalue,
		];

		$result = \dash\pdo::query($query, $param, null, ['multi_query' => true]);

		return $result;
	}

	public static function check_empty_variant_option($_parent)
	{
		$query  =
		"
			UPDATE products
			SET products.status = 'deleted'
			WHERE
				products.parent = :parent AND
				products.optionname1 IS NULL AND
				products.optionname2 IS NULL AND
				products.optionname3 IS NULL AND

				products.optionvalue1 IS NULL AND
				products.optionvalue2 IS NULL AND
				products.optionvalue3 IS NULL
		";

		$param =
		[
			':parent'      => $_parent,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function variant_child_calc($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.status != 'deleted' AND products.parent = :id LIMIT 1";

		$param =
		[
			':id'      => $_id,
		];

		$have_child = \dash\pdo::get($query, $param, 'id', true);

		$have_child = $have_child ? 1 : null;
		if(!$have_child)
		{
			$query  = "UPDATE products SET products.variant_child = NULL WHERE products.id = :id LIMIT 1";
			$result = \dash\pdo::query($query, $param);
			return $result;
		}
	}


	public static function update_all_unit($_new_unit_id, $_old_unit_id)
	{

		$query  = "UPDATE products SET products.unit_id = :new_unit_id WHERE products.unit_id = :old_unit_id";

		$param =
		[
			':new_unit_id'      => $_new_unit_id,
			':old_unit_id'      => $_old_unit_id,
		];

		$result = \dash\pdo::query($query, $param);

		return $result;
	}


	public static function clean_all_unit($_old_unit_id)
	{
		$query  = "UPDATE products SET products.unit_id = NULL WHERE products.unit_id = :old_unit_id";

		$param =
		[
			':old_unit_id'      => $_old_unit_id,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function update_all_company($_new_company_id, $_old_company_id)
	{
		$query  = "UPDATE products SET products.company_id = :new_company_id WHERE products.company_id = :old_company_id";

		$param =
		[
			':new_company_id'      => $_new_company_id,
			':old_company_id'      => $_old_company_id,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function clean_all_company($_old_company_id)
	{
		$query  = "UPDATE products SET products.company_id = NULL WHERE products.company_id = :old_company_id";

		$param =
		[
			':old_company_id'      => $_old_company_id,
		];


		$result = \dash\pdo::query($query, $param);
		return $result;
	}





	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('products', $_args, $_id);
	}



	public static function thumb($_thumb, $_id)
	{
		$param =
		[
			':id'      => $_id,
		];

		if($_thumb)
		{
			$query  = "UPDATE products SET products.thumb = :thumb WHERE products.id = :id LIMIT 1";
			$param[':thumb'] = $_thumb;
		}
		else
		{
			$query  = "UPDATE products SET products.thumb = NULL WHERE products.id = :id LIMIT 1";
		}


		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function gallery($_gallery, $_id)
	{
		$query  = "UPDATE products SET products.gallery = :gallery WHERE products.id = :id LIMIT 1";

		$param =
		[
			':id'      => $_id,
			':gallery' => $_gallery,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}

	public static function gallery_set_null($_id)
	{
		$query  = "UPDATE products SET products.gallery = NULL WHERE products.id = :id LIMIT 1";

		$param =
		[
			':id'      => $_id,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}



	public static function status_by_parent($_status, $_parent)
	{
		$query  = "UPDATE products SET products.status = :status WHERE products.parent = :parent ";

		$param =
		[
			':parent' => $_parent,
			':status' => $_status,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}



	public static function status($_status, $_id)
	{
		$query  = "UPDATE products SET products.status = :status WHERE products.id = :id LIMIT 1";

		$param =
		[
			':id' => $_id,
			':status' => $_status,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function variants_update_all_child($_parent_id, $_args)
	{
		if(!empty($_update))
		{

			$q      = \dash\pdo\prepare_query::generate_set('products', $_args);

			$query  = "UPDATE `products` SET $q[set] WHERE products.parent = :parent";

			$param  = array_merge($q['param'], [':parent' => $_parent_id]);

			$result = \dash\pdo::query($query, $param);

			return $result;
		}

		return null;
	}



	public static function variants_update($_variants, $_id)
	{
		$query  = "UPDATE products SET products.variants = :variants WHERE products.id = :id LIMIT 1";

		$param =
		[
			':id'       => $_id,
			':variants' => $_variants,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}

	public static function variants_clean_product($_id)
	{
		$query  = "UPDATE products SET products.variants = NULL WHERE products.id = :id LIMIT 1";

		$param =
		[
			':id'       => $_id,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}



}
?>