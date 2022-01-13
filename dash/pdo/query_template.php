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

			if($value === '')
			{
				$value = null;
			}
			elseif(is_bool($value) && !$value)
			{
				$value = null;
			}

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

		$insert_id = \dash\pdo::insert_id();

		// have not AUTO INCREMENT id
		if($result && !$insert_id)
		{
			return $result;
		}

		return $insert_id;
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
			if(is_bool($value) && !$value)
			{
				$value = null;
			}

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


	/**
	 * Get full table ros
	 *
	 * @param      string  $_table  The table
	 * @param      <type>  $_fuel   The fuel
	 *
	 * @return     float   ( description_of_the_return_value )
	 */
	public static function table_rows(string $_table, $_fuel = null) : float
	{
		$query  = "SELECT COUNT(*) AS 'count' FROM `$_table`";
		$result = \dash\pdo::get($query, [], 'count', true, $_fuel);
		return floatval($result);
	}


	/**
	 * Get count
	 *
	 * @param      string  $_table  The table
	 * @param      array   $_where  The where
	 * @param      <type>  $_fuel   The fuel
	 *
	 * @return     float   The count.
	 */
	public static function get_count(string $_table, $_where = [], $_fuel = null) : float
	{
		if(!$_where || !is_array($_where))
		{
			return self::table_rows($_table, $_fuel);
		}

		$q = prepare_query::generate_where($_table, $_where);

		$query  = "SELECT COUNT(*) AS 'count' FROM `$_table` WHERE $q[where] ";

		$param = $q['param'];

		$result = \dash\pdo::get($query, $param, 'count', true, $_fuel);

		return floatval($result);
	}


	/**
	 * Simple list by pagenation
	 *
	 * @param      string  $_table  The table
	 * @param      <type>  $_fuel   The fuel
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function list_pagenation(string $_table, $_fuel = null)
	{
		$pagination_query = "SELECT COUNT(*) AS `count` FROM $_table ";

		$limit = \dash\db\pagination::pagination_query($pagination_query, [], 10, $_fuel);

		$query = "SELECT * FROM $_table ORDER BY $_table.id DESC $limit";

		$result = \dash\pdo::get($query, [], null, false, $_fuel);

		return $result;

	}


	/**
	 * public get from tables
	 *
	 * @param      <type>  $_table  The table
	 * @param      <type>  $_where   The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get_where(string $_table,  array $_where = [], $_fuel = null)
	{
		$param          = [];
		$only_one_value = false;
		$limit          = null;

		if(isset($_where['limit']))
		{
			if($_where['limit'] === 1)
			{
				$only_one_value = true;
			}

			$limit = " LIMIT :_limit ";
			$param[':_limit'] = $_where['limit'];
		}

		unset($_where['limit']);

		$q = prepare_query::generate_where($_table, $_where);


		$param  = array_merge($param, $q['param']);
		$query  = "SELECT * FROM $_table WHERE $q[where] $limit ";
		$result = \dash\pdo::get($query, $param, null, $only_one_value, $_fuel);

		return $result;
	}
}
?>