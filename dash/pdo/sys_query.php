<?php
namespace dash\pdo;

class sys_query
{

	public static function timeout_setting()
	{
		$query = " SHOW GLOBAL VARIABLES LIKE '%wait%'";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function show_glogal(string $_keyword)
	{
		$query = " SHOW GLOBAL VARIABLES LIKE '%$_keyword%'";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function show_status(string $_keyword)
	{
		$query = " SHOW STATUS LIKE '%$_keyword%'";
		$result = \dash\pdo::get($query);
		return $result;
	}




	public static function test_connection($_fuel, $_db_name = 'mysql')
	{
		$var = 'JIBRES_TEST_CONNECTION';

		$result = \dash\pdo::get("SELECT '$var'; -- $_fuel ", [], $var, true, $_fuel, ['database' => $_db_name]);

		if($result === $var)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public static function show_databases($_fuel)
	{
		$query = "SHOW DATABASES;";
		$result = \dash\pdo::get($query, [],null, false, $_fuel, ['database' => 'mysql']);
		return $result;
	}


	public static function count_table($_fuel, $_db_name)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				INFORMATION_SCHEMA.TABLES
			WHERE
				TABLE_SCHEMA = '$_db_name'
		";

		$result = \dash\pdo::get($query, [], 'count', true, $_fuel, ['database' => $_db_name]);

		return floatval($result);
	}


	public static function database_exist($_fuel, $_db_name)
	{
		$query =
		"
			SELECT
				SCHEMA_NAME
			FROM
				INFORMATION_SCHEMA.SCHEMATA
			WHERE
				SCHEMA_NAME = '$_db_name'
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], 'SCHEMA_NAME', true, $_fuel, ['database' => 'mysql']);

		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	/**
	 * Creates a database.
	 *
	 * @param      <type>  $_fuel     The fuel
	 * @param      <type>  $_db_name  The database name
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function create_database($_fuel, $_db_name)
	{
		$query = "CREATE DATABASE IF NOT EXISTS `$_db_name` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
		$result = \dash\pdo::query($query, [], $_fuel, ['database' => 'mysql']);
		return $result;
	}


	public static function drop_database($_fuel, $_db_name)
	{
		$query = "DROP DATABASE `$_db_name`; ";
		$result = \dash\pdo::query($query, [], $_fuel, ['database' => 'mysql']);
		return $result;
	}

}
?>