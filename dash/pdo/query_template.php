<?php
namespace dash\pdo;

/**
 * This class describes a query template.
 * Function of this class must be use only in db level
 * Do not use this function in app or api level!
 */
class query_template
{

	public static function insert($_table, $_args, $_fuel = null, $_option = [])
	{
		if(empty($_args))
		{
			return false;
		}

		$set   = [];
		$param = [];

		foreach ($_args as $key => $value)
		{
			$fields[]        = $key;
			$new_key         = ':'. $key;
			$set[$key]       = $new_key;
			$param[$new_key] = $value;
		}

		$IGNORE = null;

		if(a($_option, 'ignore'))
		{
			$IGNORE = 'IGNORE';
		}

		$query = "INSERT $IGNORE INTO `$_table` SET ";

		$query_set = [];

		foreach ($set as $key => $value)
		{
			$query_set[] = " $_table.$key = $value ";
		}

		$query .= implode(',', $query_set);

		$result = \dash\pdo::query($query, $param, $_fuel, $_option);

		return \dash\pdo::insert_id();
	}


	public static function multi_insert($_table, $_args, $_fuel = null, $_option = [])
	{

		$args = prepare_query::ready_for_multi_insert($_args);
		if(!$args)
		{
			return false;
		}


		$IGNORE = null;

		if(a($_option, 'ignore'))
		{
			$IGNORE = 'IGNORE';
		}

		$query = "INSERT $IGNORE INTO `$_table` $args[query] ";

		$result = \dash\pdo::query($query, $args['param'], $_fuel, $_option);

		return \dash\pdo::insert_id();
	}


	public static function update($_table, $_args, $_id, $_fuel = null, $_option = [])
	{
		if(empty($_args))
		{
			return false;
		}

		$set   = [];
		$param = [];

		foreach ($_args as $key => $value)
		{
			$fields[]        = $key;
			$new_key         = ':'. $key;
			$set[$key]       = $new_key;
			$param[$new_key] = $value;
		}

		$query = "UPDATE `$_table` SET ";

		$query_set = [];

		foreach ($set as $key => $value)
		{
			$query_set[] = " $_table.$key = $value ";
		}

		$query .= implode(',', $query_set);

		$query .= " WHERE $_table.id = :_id LIMIT 1 ";

		$param[':_id'] = $_id;

		$result = \dash\pdo::query($query, $param, $_fuel, $_option);

		return $result;
	}



	public static function get($_table, $_id, $_fuel = null, $_option = [])
	{
		$query = "SELECT * FROM `$_table` WHERE `$_table`.`id` = :_id LIMIT 1 ";

		$param = [':_id' => $_id];

		$result = \dash\pdo::get($query, $param, null, true, $_fuel, $_option);

		return $result;
	}


	public static function get_for_update($_table, $_id, $_fuel = null, $_option = [])
	{
		$query = "SELECT * FROM `$_table` WHERE `$_table`.`id` = :_id LIMIT 1 FOR UPDATE ";

		$param = [':_id' => $_id];

		$result = \dash\pdo::get($query, $param, null, true, $_fuel, $_option);

		return $result;
	}



	public static function ready_pdo_query_args($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];


		if($_and)
		{
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		$start_limit = null;
		if(array_key_exists('start_limit', $_meta))
		{
			$start_limit = $_meta['start_limit'];
		}

		if(isset($_meta['join']) && is_array($_meta['join']) && $_meta['join'])
		{
			$join = implode(' ', $_meta['join']);
		}
		else
		{
			$join = null;
		}

		$fields = '*';
		if(isset($_meta['fields']))
		{
			$fields = $_meta['fields'];
		}

		$result =
		[
			'where'       => $where,
			'order'       => $order,
			'pagination'  => $pagination,
			'limit'       => $limit,
			'start_limit' => $start_limit,
			'join'        => $join,
			'fields'      => $fields,
			'limit_string' => "LIMIT $limit",
		];

		return $result;
	}

}
?>