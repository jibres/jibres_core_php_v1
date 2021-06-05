<?php
namespace dash\pdo;

class query_template
{

	public static function insert($_table, $_args)
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

		$query = "INSERT INTO `$_table` SET ";

		$query_set = [];

		foreach ($set as $key => $value)
		{
			$query_set[] = " $_table.$key = $value ";
		}

		$query .= implode(',', $query_set);

		$result = \dash\pdo::query($query, $param);

		return \dash\pdo::insert_id();
	}


	public static function update($_table, $_args, $_id)
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

		$result = \dash\pdo::query($query, $param);

		return $result;
	}
}
?>