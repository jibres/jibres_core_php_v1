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
				information_schema.tables
			WHERE table_schema = '$db_name'
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
}
?>