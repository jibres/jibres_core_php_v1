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
}
?>