<?php
namespace lib\db\factor;

trait search
{
	private static $public_show_field =
	"
		factors.*,
		userstores.firstname AS `customer_firstname`,
		userstores.lastname AS `customer_lastname`,
		userstores.displayname AS `customer_displayname`,
		userstores.mobile AS `customer_mobile`,
		userstores.gender AS `customer_gender`
	";

	private static $master_join = " LEFT JOIN userstores ON userstores.id = factors.customer ";

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
		];

		$master_join = self::$master_join;

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
			$public_fields  = " COUNT(*) AS 'searchcount' FROM	`factors` ";
			$limit          = null;
			$only_one_value = true;
		}
		else
		{
			$limit             = null;

			$public_show_field = self::$public_show_field;

			$public_fields = " $public_show_field FROM `factors` ";

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
				$order = " ORDER BY `factors`.`id` DESC ";
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
				$order = " ORDER BY `factors`.`id` $_options[order] ";
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
		if($_string !== null && $_string)
		{
			$_string   = trim($_string);
			$en_number = \dash\utility\convert::to_en_number($_string);

			$string_decode = \dash\coding::decode($_string);
			if(!$string_decode)
			{
				$string_decode = null;
			}
			else
			{
				$string_decode = " OR factors.id  = $string_decode ";
			}
			$search_in_id = null;

			if(\dash\coding::is($_string))
			{
				$search_in_id = "factors.id = '". \dash\coding::decode($_string). "' OR ";
			}

			if(is_numeric($en_number))
			{
				$search =
				"
				(
					$search_in_id
					userstores.displayname  LIKE '%$_string%' OR
					factors.date       = '$en_number' OR
					factors.shamsidate = '$en_number'
				)
				$string_decode
				";

			}
			else
			{
				$search =
				"
				(
					userstores.displayname  LIKE '%$_string%'
				)
				$string_decode
				";
			}

				// factors.title          = '$_string' OR
				// factors.detailsum      = '$en_number' OR
				// factors.detaildiscount = '$en_number' OR
				// factors.detailtotalsum = '$en_number' OR
				// factors.item           = '$en_number' OR
				// factors.qty            = '$en_number' OR
				// factors.discount       = '$en_number' OR
				// factors.sum            = '$_string' OR
				// factors.title 	    LIKE '%$_string%'

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
			$pagenation_query = "SELECT	COUNT(*) AS `count`	FROM `factors` $master_join	$where $search ";
			$pagenation_query = \dash\db::get($pagenation_query, 'count', true);

			// list($limit_start, $limit) = \dash\utility\pagination::get_query_limit((int) $pagenation_query, $_options['page'], $limit);

			list($limit_start, $limit) = \dash\db::pagnation((int) $pagenation_query, $limit);
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

		$query = " SELECT $public_fields $master_join $where $search $order $limit -- factors::search() 	-- $json";

		if(!$only_one_value)
		{
			$result = \dash\db::get($query, null, false);
			$result = \dash\utility\filter::meta_decode($result);
		}
		else
		{
			$result = \dash\db::get($query, 'searchcount', true);
		}

		return $result;
	}
}
?>