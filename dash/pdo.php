<?php
namespace dash;

/** Create simple and clean connection to db with PDO **/

class pdo
{

	/**
	 * run query string and return result
	 * now you don't need to check result
	 * @param  [type] $_qry [description]
	 * @return [type]       [description]
	 */
	public static function query($_qry, $_param = [], $_db_fuel = null, $_options = [])
	{
		\dash\notif::turn_off_log();

		$default_options =
		[
			// run mysqli_multi_query
			'multi_query'  => false,
			'database'     => null,
			'bind'         => null, // buind query
			// if have error in connection or anything ignore it and return false
			'ignore_error' => false,
			'fetch_all'    => false,


		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		// get time before execute query
		$qry_exec_time = microtime(true);

		$myDbFuel =
		[
			'fuel'         => ((is_string($_db_fuel) || is_numeric($_db_fuel)) && $_db_fuel) ? $_db_fuel : null,
			'database'     => $_options['database'],
			'ignore_error' => $_options['ignore_error'],
		];

		\dash\pdo\connection::connect($myDbFuel);

		$link = \dash\pdo\connection::link();

		var_dump($link);

		// check the mysql link
		if(!$link)
		{
			\dash\notif::turn_on_log();
			return null;
		}

		$sth = $link->prepare($_qry);

		var_dump($sth);

		// $sth->bindParam(':calories', $calories, PDO::PARAM_INT);

		if(!is_array($_param))
		{
			$_param = [];
		}

		foreach ($_param as $key => $value)
		{
			$type = \PDO::PARAM_STR;

			if(is_string($value))
			{
				$type = \PDO::PARAM_STR;
			}
			elseif(is_numeric($value))
			{
				$type = \PDO::PARAM_INT;
			}
			elseif(is_null($value))
			{
				$type = \PDO::PARAM_NULL;
			}
			elseif(is_bool($value))
			{
				$type = \PDO::PARAM_BOOL;
			}

			$sth->bindValue($key, $value, $type);
		}

		$result = $sth->execute();

		if(isset($_options['fetch_all']) && $_options['fetch_all'])
		{
			$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
		}

		\dash\notif::turn_on_log();

		// return the mysql result
		return $result;
	}


	/**
	 * run query and get result of this query
	 * @param  [type]  $_qry          [description]
	 * @param  [type]  $_column       [description]
	 * @param  boolean $_onlyOneValue [description]
	 * @return [type]                 [description]
	 */
	public static function get($_qry, $_param = [], $_column = null, $_onlyOneValue = false, $_db_fuel = true, $_options = [])
	{
		$_options['fetch_all'] = true;
		// generate query and get result
		$result = self::query($_qry, $_param, $_db_fuel, $_options);

		// if we have only one row of result only return this row
		if($_onlyOneValue && is_array($result) && count($result) === 1)
		{
			if(isset($result[0]))
			{
				$result = $result[0];
			}
			else
			{
				$result = null;
			}
		}

		return $result;
	}





	/**
	 * transaction
	 */
	public static function transaction($_db_fuel = true)
	{
		if($_link === null)
		{
			$_link = \dash\pdo\connection::link();
		}

		if(!$_link)
		{
			return false;
		}

		return $_link->beginTransaction();

	}


	/**
	 * commit
	 */
	public static function commit($_db_fuel = true)
	{
		if($_link === null)
		{
			$_link = \dash\pdo\connection::link();
		}

		if(!$_link)
		{
			return false;
		}

		return $_link->commit();

	}


	/**
	 * rollback
	 */
	public static function rollback($_db_fuel = true)
	{
		if($_link === null)
		{
			$_link = \dash\pdo\connection::link();
		}

		if(!$_link)
		{
			return false;
		}

		return $_link->rollBack();

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
			$_link = \dash\pdo\connection::link();
		}

		if(!$_link)
		{
			return false;
		}

		return $_link->lastInsertId();

	}



}
?>