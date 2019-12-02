<?php
namespace dash\db\mysql\tools;

trait info
{
	private static $all_db_version = [];

	/**
	 * read query info and analyse it and return array contain result
	 * @return [type] [description]
	 */
	public static function qry_info($_needle = null, $_link = null)
	{
		if($_link === null)
		{
			$_link = self::$link;
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
			$_link = self::$link;
		}

		$result = self::get("SHOW GLOBAL STATUS;", ['Variable_name', 'Value'], true);

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


	public static function get_size($_link = null)
	{
		if($_link === null)
		{
			$_link = self::$link;
		}

		$db_name = self::$db_name;

		$query =
		"
			SELECT
				ROUND(SUM(data_length + index_length) / 1024 , 0) AS `dbsize`
			FROM
				information_schema.tables
			WHERE
				table_schema = '$db_name'
		";
		$result = self::get($query, 'dbsize', true);
		return $result;
	}


	/**
	 * get rows matched
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function rows_matched($_link = null)
	{
		return self::qry_info("Rows matched", $_link);
	}


	/**
	 * get rows changed
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function changed($_link = null)
	{
		return self::qry_info("Changed", $_link);
	}


	/**
	 * get the warnings
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function warnings($_link = null)
	{
		return self::qry_info("Warnings", $_link);
	}


	/**
	 * return the last insert id
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert_id($_link = null)
	{
		if($_link === null)
		{
			$_link = self::$link;
		}
		$last_id = @mysqli_insert_id($_link);
		return $last_id;
	}


	/**
	 * return version of mysql used on server
	 * @return [type] [description]
	 */
	public static function version($_link = null)
	{
		if($_link === null)
		{
			$_link = self::$link;
		}
		// mysqli_get_client_info();
		// mysqli_get_client_version();
		return mysqli_get_server_version($_link);
	}


	/**
	 * get num rows of query
	 *
	 * @return     <int>  ( description_of_the_return_value )
	 */
	public static function num($_link = null)
	{
		if($_link === null)
		{
			$_link = self::$link;
		}
		$num = @mysqli_num_rows($_link);
		// $num = self::$link->affected_rows;
		return $num;
	}


	/**
	 * get the affected rows
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function affected_rows($_link = null)
	{
		if($_link === null)
		{
			$_link = self::$link;
		}
		return mysqli_affected_rows($_link);
	}


	/**
	 * return the mysql error
	 */
	public static function error($_link = null)
	{
		if($_link === null)
		{
			$_link = self::$link;
		}
		return @mysqli_error($_link);
	}


	/**
	 * get the database version from options table
	 *
	 * @param      boolean  $_db_name  The database name
	 */
	public static function db_version($_db_name = true, $_time = false)
	{
		$version = null;

		$file_name = $_db_name;

		if($_db_name === true)
		{
			$file_name = self::$db_name;
		}

		$file_url = database;
		if(!\dash\file::exists($file_url))
		{
			\dash\file::makeDir($file_url);
		}

		$file_url = database. 'version/';
		if(!\dash\file::exists($file_url))
		{
			\dash\file::makeDir($file_url);
		}

		$file_url .= $file_name;

		if(\dash\file::exists($file_url))
		{
			if($_time)
			{
				$version = \dash\file::mtime($file_url);
			}
			else
			{
				$version = \dash\file::read($file_url);
			}
		}
		else
		{
			\dash\file::write($file_url, null);
		}

		return $version;
	}


	/**
	 * Sets the database version.
	 *
	 * @param      <type>   $_version  The version
	 * @param      boolean  $_db_name  The database name
	 */
	public static function set_db_version($_version, $_db_name = true)
	{
		$file_name = $_db_name;

		if($_db_name === true)
		{
			$file_name = self::$db_name;
		}

		$file_url = database. 'version/';

		if(!\dash\file::exists($file_url))
		{
			\dash\file::makeDir($file_url);
		}

		$file_url .= $file_name;

		\dash\file::write($file_url, $_version);

	}
}
?>
