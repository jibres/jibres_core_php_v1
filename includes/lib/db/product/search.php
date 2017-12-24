<?php
namespace lib\db\product;

trait search
{

	private static $public_show_field =
	"
		(products.price - products.discount) AS `finalprice`,
		((products.price - products.discount) * 100 / products.buyprice) AS `intrestrate`,
		ROUND(products.price * 100 / products.buyprice, 2) - 100 AS `intrestrate_impure`,
		products.*
	";


	public static function search_id($_id, $_store_id)
	{
		$field = self::$public_show_field;
		$query =
		"
			SELECT
				$field
			FROM
				products
			WHERE
				products.id       = '$_id' AND
				products.store_id = $_store_id
			LIMIT 1
		";

		return \lib\db::get($query, null, true);
	}


	public static function search_barcode($_barcode, $_store_id)
	{
		$field           = self::$public_show_field;
		$barcode         = $_barcode;
		$barcode_convert = \lib\utility\convert::to_barcode($barcode);

		if($barcode == $barcode_convert)
		{
			$query =
			"
				SELECT
					$field
				FROM
					products
				WHERE
					products.store_id = $_store_id AND
					(
						products.barcode  = '$barcode' OR
						products.barcode2 = '$barcode'
					)
				LIMIT 1
			";
		}
		else
		{
			$query =
			"
				SELECT
					$field
				FROM
					products
				WHERE
					products.store_id = $_store_id AND
					(
						products.barcode  = '$barcode' OR
						products.barcode2 = '$barcode' OR
						products.barcode  = '$barcode_convert' OR
						products.barcode2 = '$barcode_convert'
					)
				LIMIT 1
			";
		}
		return \lib\db::get($query, null, true);
	}


	/**
	 * Searches for the first match.
	 *
	 * @param      <type>  $_string   The string
	 * @param      array   $_options  The options
	 */
	public static function search($_string = null, $_options = [], $_field = [])
	{

		$where = []; // conditions

		if(!$_string && empty(array_filter($_options)))
		{
			// default return of this function 10 last record of search
			$_options['get_last'] = true;
		}

		$default_options =
		[
			// just return the count record
			"get_count"      => false,
			// enable|disable paignation,
			"pagenation"     => true,
			// for example in get_count mode we needless to limit and pagenation
			// default limit of record is 10
			// set the limit = null and pagenation = false to get all record whitout limit
			"limit"          => 10,
			// for manual pagenation set the statrt_limit and end limit
			"start_limit"    => 0,
			// for manual pagenation set the statrt_limit and end limit
			"end_limit"      => 10,
			// the the last record inserted to post table
			"get_last"       => false,
			// default order by DESC you can change to DESC
			"order"          => "DESC",
			// custom sort by field
			"sort"           => null,

			"page"           => 1,
			// just search in one field
			'just_one_field' => false,
		];

		// if limit not set and the pagenation is false
		// remove limit from query to load add record
		if(!isset($_options['limit']) && array_key_exists('pagenation', $_options) && $_options['pagenation'] === false)
		{
			$default_options['limit'] = null;
			$default_options['end_limit'] = null;
		}

		$_options = array_merge($default_options, $_options);

		$pagenation = false;
		if($_options['pagenation'])
		{
			// page nation
			$pagenation = true;
		}

		// ------------------ get count
		$only_one_value = false;
		$get_count      = false;

		if($_options['get_count'] === true)
		{
			$get_count      = true;
			$public_fields  = " COUNT(*) AS 'searchcount' FROM	`products` ";
			$limit          = null;
			$only_one_value = true;
		}
		else
		{
			$limit             = null;

			$public_show_field = self::$public_show_field;

			$public_fields = " $public_show_field FROM `products` ";

			if($_options['limit'])
			{
				$limit = $_options['limit'];
			}
		}


		if($_options['sort'])
		{
			$temp_sort = null;
			switch ($_options['sort'])
			{
				default:
					$temp_sort = $_options['sort'];
					break;
			}
			$_options['sort'] = $temp_sort;
		}

		// ------------------ get last
		$order = null;
		if($_options['get_last'])
		{
			if($_options['sort'])
			{
				$order = " ORDER BY $_options[sort] $_options[order] ";
			}
			else
			{
				$order = " ORDER BY `products`.`id` DESC ";
			}
		}
		else
		{
			if($_options['sort'])
			{
				if(!preg_match("/\./", $_options['sort']))
				{
					$order = " ORDER BY `$_options[sort]` $_options[order] ";
				}
				else
				{
					$order = " ORDER BY $_options[sort] $_options[order] ";
				}
			}
			else
			{
				$order = " ORDER BY `products`.`id` $_options[order] ";
			}
		}

		$start_limit = $_options['start_limit'];
		$end_limit   = $_options['end_limit'];

		$no_limit = false;
		if($_options['limit'] === false)
		{
			$no_limit = true;
		}

		$search_field = null;


		foreach ($_field as $key => $value)
		{
			if(!preg_match("/\./", $key))
			{
				$fkey = " `$key` ";
			}
			else
			{
				$fkey = " $key ";
			}

			if(is_array($value))
			{
				if(isset($value[0]) && isset($value[1]) && is_string($value[0]) && is_string($value[1]))
				{
					// for similar "search.`field` LIKE '%valud%'"
					$where[] = " $fkey $value[0] $value[1] ";
				}
			}
			elseif($value === null)
			{
				$where[] = " $fkey IS NULL ";
			}
			elseif(is_numeric($value))
			{
				$where[] = " $fkey = $value ";
			}
			elseif(is_string($value))
			{
				$where[] = " $fkey = '$value' ";
			}
		}

		$where = join($where, " AND ");
		$search = null;
		if($_string !== null && !$_options['just_one_field'])
		{
			$search_in_code = false;

			if(substr($_string, 0, 1) === '+')
			{
				$_string        = trim($_string);
				$my_code        = substr($_string, 1);
				$search_in_code = true;
			}
			else
			{
				$_string   = trim($_string);
				$barcode   = \lib\utility\convert::to_barcode($_string);
				$en_number = \lib\utility\convert::to_en_number($_string);
			}

			// search by +
			if($search_in_code)
			{
				$search =
				"
				(
					products.code = '$my_code'
				)
				";
			}
			else
			{
				if(is_numeric($_string))
				{
					$search_in_numeric_field =
					"
						products.price    = '$en_number' 	OR
						products.discount = '$en_number' 	OR
						products.buyprice = '$en_number' 	OR
					";
				}
				else
				{
					$search_in_numeric_field = null;
				}

				$search =
				"
				(
					products.title 	  LIKE '%$_string%' OR

					$search_in_code

					products.cat 	  = '$_string' 		OR
					products.unit 	  = '$_string' 		OR

					$search_in_numeric_field

					products.barcode  = '$_string' 		OR
					products.barcode2 = '$_string' 		OR

					products.barcode  = '$barcode' 		OR
					products.barcode2 = '$barcode'
				)
				";

			}

			if($where)
			{
				$search = " AND ". $search;
			}
		}

		if($where)
		{
			$where = "WHERE $where";
		}
		elseif($search)
		{
			$where = "WHERE";
		}

		if($pagenation && !$get_count)
		{
			$pagenation_query = "SELECT	COUNT(*) AS `count`	FROM `products` 	$where $search ";
			$pagenation_query = \lib\db::get($pagenation_query, 'count', true);

			// list($limit_start, $limit) = \lib\utility\pagination::get_query_limit((int) $pagenation_query, $_options['page'], $limit);

			list($limit_start, $limit) = \lib\db::pagnation((int) $pagenation_query, $limit);
			$limit = " LIMIT $limit_start, $limit ";
		}
		else
		{
			// in get count mode the $limit is null
			if($limit)
			{
				$limit = " LIMIT $start_limit, $end_limit ";
			}
		}

		$json = json_encode(func_get_args());
		if($no_limit)
		{
			$limit = null;
		}

		$query = " SELECT $public_fields $where $search $order $limit -- products::search() 	-- $json";

		if(!$only_one_value)
		{
			$result = \lib\db::get($query, null, false);
			$result = \lib\utility\filter::meta_decode($result);
		}
		else
		{
			$result = \lib\db::get($query, 'searchcount', true);
		}

		return $result;
	}
}
?>