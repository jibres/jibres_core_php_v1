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

		$query = "INSERT INTO `crm_email` SET ";

		$query_set = [];

		foreach ($set as $key => $value)
		{
			$query_set[] = " crm_email.$key = $value ";
		}

		$query .= implode(',', $query_set);

		$result = \dash\pdo::query($query, $param);

		return $insert;
	}
}
?>