<?php
namespace dash\db\mysql\tools;

class info
{

	public static function timeout_setting()
	{
		$query = " SHOW GLOBAL VARIABLES LIKE '%wait%'";
		$result = \dash\db::get($query);
		return $result;
	}


	/**
	 * read query info and analyse it and return array contain result
	 * @return [type] [description]
	 */
	public static function qry_info($_needle = null, $_link = null)
	{
		if($_link === null)
		{
			$_link = \dash\db\mysql\tools\connection::link();
		}

		if(!$_link)
		{
			return false;
		}

		preg_match_all ('/(\S[^:]+): (\d+)/', mysqli_info($_link), $matches);
		$info = array_combine ($matches[1], $matches[2]);
		if($_needle && isset($info[$_needle]))
		{
			$info = $info[$_needle];
		}
		return $info;
	}


	public static function global_status($_link = null, $_get = null)
	{
		if($_link === null)
		{
			$_link = \dash\db\mysql\tools\connection::link();
		}

		$result = \dash\db::get("SHOW GLOBAL STATUS;", ['Variable_name', 'Value'], true);

		if($_get && is_array($result))
		{
			if(array_key_exists($_get, $result))
			{
				return $result[$_get];
			}
			return null;
		}
		else
		{
			return $result;
		}
	}


	public static function db_size()
	{
		$db_name = \dash\db\mysql\tools\connection::get_last_db_name();

		if(!$db_name)
		{
			return null;
		}

		$query =
		"
			SELECT
				ROUND(SUM(data_length + index_length) / 1024 / 1024, 4) AS `size`
			FROM
				INFORMATION_SCHEMA.TABLES
			WHERE TABLE_SCHEMA = '$db_name'
		";
		$result = \dash\db::get($query, 'size', true);
		return $result;
	}


	public static function test_connection($_fuel, $_db_name = 'mysql')
	{
		$var = 'JIBRES_TEST_CONNECTION';

		$result = \dash\db::get("SELECT '$var'; -- $_fuel ", $var, true, $_fuel, ['database' => $_db_name]);

		if($result === $var)
		{
			return true;
		}
		else
		{
			return false;
		}
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

		$result = \dash\db::get($query, 'count', true, $_fuel, ['database' => $_db_name]);

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

		$result = \dash\db::get($query, 'SCHEMA_NAME', true, $_fuel, ['database' => 'mysql']);

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
		$result = \dash\db::query($query, $_fuel, ['database' => 'mysql']);
		return $result;
	}


	public static function drop_database($_fuel, $_db_name)
	{
		$query = "DROP DATABASE `$_db_name`; ";
		$result = \dash\db::query($query, $_fuel, ['database' => 'mysql']);
		return $result;
	}

}
?>