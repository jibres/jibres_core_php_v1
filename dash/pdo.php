<?php
namespace dash;

/** Create simple and clean connection to db with PDO **/

class pdo
{

	/**
	 * run query string and return result
	 * @param  [type] $_query [description]
	 * @return [type]       [description]
	 */
	public static function query($_query, $_param = [], $_db_fuel = null, $_options = [])
	{
		\dash\notif::turn_off_log();

		$default_options =
		[
			// run mysqli_multi_query
			'multi_query'      => false,
			'database'         => null,
			'bind'             => null, // buind query

			// if have error in connection or anything ignore it and return false
			'ignore_error'     => false,
			'fetch_all'        => false,
			'transaction_mode' => false,


		];

		if(!is_array($_options))
		{
			$_options = [];
		}


		if(!is_array($_param))
		{
			$_param = [];
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

		$_query_log = 'PDO; '. $_query;

		// get time before execute query
		$qry_exec_time = microtime(true);

		\dash\pdo\connection::connect($myDbFuel);

		$link = \dash\pdo\connection::link();

		if($_options['transaction_mode'])
		{
			return $link;
		}

		// check the mysql link
		if(!$link)
		{
			\dash\notif::turn_on_log();
			return null;
		}

		try
		{
			$sth = $link->prepare($_query);

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
		}
		catch (\Exception $e)
		{
			$error = $_query_log;
			$error .= "\n". $e->getMessage();

			\dash\pdo\log::log($error);

			return false;
		}

		// get diff of time after exec
		$qry_exec_time = microtime(true) - $qry_exec_time;

		// if debug mod is true save all string query
		if(\dash\engine\error::debug_mode() && !\dash\temp::get('force_stop_query_log'))
		{
			if(\dash\url::directory() === 'smile')
			{
				// nothing
			}
			else
			{
				\dash\db\mysql\tools\log::log($_query_log . ' -- '. \dash\db\mysql\tools\connection::get_last_fuel_detail(), $qry_exec_time);
			}
		}
		// calc exex time in ms
		$qry_exec_time_ms = round($qry_exec_time*1000);
		// if spend more time, save it in special file
		if($qry_exec_time_ms > 6000)
		{
			\dash\db\mysql\tools\log::log($_query_log, $qry_exec_time, 'log-hard-critical.sql');
		}
		elseif($qry_exec_time_ms > 3000)
		{
			\dash\db\mysql\tools\log::log($_query_log, $qry_exec_time, 'log-critical.sql');
		}
		elseif($qry_exec_time_ms > 1000)
		{
			\dash\db\mysql\tools\log::log($_query_log, $qry_exec_time, 'log-warn.sql');
		}
		elseif($qry_exec_time_ms > 500)
		{
			\dash\db\mysql\tools\log::log($_query_log, $qry_exec_time, 'log-check.sql');
		}

		\dash\notif::turn_on_log();

		// return the mysql result
		return $result;
	}


	/**
	 * run query and get result of this query
	 * @param  [type]  $_query          [description]
	 * @param  [type]  $_column       [description]
	 * @param  boolean $_onlyOneValue [description]
	 * @return [type]                 [description]
	 */
	public static function get($_query, $_param = [], $_column = null, $_onlyOneValue = false, $_db_fuel = true, $_options = [])
	{
		$_options['fetch_all'] = true;
		// generate query and get result
		$result = self::query($_query, $_param, $_db_fuel, $_options);

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
	public static function transaction($_db_fuel = null)
	{
		$link = self::query(null, [], $_db_fuel, ['transaction_mode' => true]);

		if(!$link)
		{
			return false;
		}

		try
		{
			return $link->beginTransaction();
		}
		catch (\Exception $e)
		{

			\dash\pdo\log::log($e->getMessage());

			\dash\notif::error(T_("Can not start transaction on PDO link!"));

			return false;
		}



	}


	/**
	 * commit
	 */
	public static function commit($_db_fuel = null)
	{
		$link = self::query(null, [], $_db_fuel, ['transaction_mode' => true]);

		if(!$link)
		{
			return false;
		}

		try
		{
			return $link->commit();
		}
		catch (\Exception $e)
		{

			\dash\pdo\log::log($e->getMessage());

			\dash\notif::error(T_("Can not commit PDO link!"));

			return false;
		}


	}


	/**
	 * rollback
	 */
	public static function rollback($_db_fuel = null)
	{
		$link = self::query(null, [], $_db_fuel, ['transaction_mode' => true]);

		if(!$link)
		{
			return false;
		}

		try
		{
			return $link->rollBack();
		}
		catch (\Exception $e)
		{

			\dash\pdo\log::log($e->getMessage());

			\dash\notif::error(T_("Can not rollback PDO link!"));

			return false;
		}
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

		try
		{
			return $_link->lastInsertId();
		}
		catch (\Exception $e)
		{

			\dash\pdo\log::log($e->getMessage());

			\dash\notif::error(T_("Can not get insert id in PDO link!"));

			return false;
		}



	}



}
?>