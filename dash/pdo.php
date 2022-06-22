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


		$myDbFuel =
		[
			'fuel'         => ((is_string($_db_fuel) || is_numeric($_db_fuel)) && $_db_fuel) ? $_db_fuel : null,
			'database'     => $_options['database'],
			'ignore_error' => $_options['ignore_error'],
		];


		// get time before execute query
		$connection_exec_time = microtime(true);

		\dash\pdo\connection::connect($myDbFuel);

		$link = \dash\pdo\connection::link();

		$connection_exec_time = microtime(true) - $connection_exec_time;

		// get time before execute query
		$qry_exec_time = microtime(true);

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

		$query_log = '';

		if($_param)
		{
			$query_log = 'BIND; ';
		}

		$query_log .= ' -- connection_time: '. round($connection_exec_time*1000). ' ms | '. PHP_EOL;
		$query_log .= $_query;

		$query_log .= ' -- '. json_encode(func_get_args());

		try
		{
			$sth = $link->prepare($_query);

			foreach ($_param as $key => $value)
			{
				// check param exist in query string
				// to fix: SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens
				if(\dash\str::strpos($_query, $key) === false)
				{
					continue;
				}

				$type = \PDO::PARAM_STR;

				if(is_int($value))
				{
					$type = \PDO::PARAM_INT;
				}
				elseif(is_float($value))
				{
					$type = \PDO::PARAM_STR;
				}
				elseif(is_string($value))
				{
					$type = \PDO::PARAM_STR;
				}
				elseif(is_numeric($value))
				{
					$type = \PDO::PARAM_STR;
				}
				elseif(is_null($value))
				{
					$type = \PDO::PARAM_NULL;
				}
				elseif(is_bool($value))
				{
					$type = \PDO::PARAM_BOOL;
				}
				else
				{
					\dash\pdo\log::log_error(0, json_encode(func_get_args()). ' -- Syntax error ', 0, 'error.sql');
					return false;
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
			$error = $query_log;
			$error .= "\n". $e->getMessage();
			$error .= "\n". json_encode($_param, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			// no result exist
			// save mysql error
			$temp_error = "#". date("Y-m-d H:i:s") ;
			$temp_error .= $error. ' - ';
			$temp_error .= ' -- '. \dash\pdo\connection::get_last_fuel_detail();

			\dash\pdo\log::log_error($link->errorCode(), $temp_error, $qry_exec_time, 'error.sql');

			if(\dash\url::isLocal())
			{
				\dash\notif::warn(nl2br($error));
			}

			\dash\notif::turn_on_log();

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
				\dash\pdo\log::log_if_debug($query_log . ' -- '. \dash\pdo\connection::get_last_fuel_detail(), $qry_exec_time);
			}
		}

		// calc exex time in ms
		$qry_exec_time_ms = round(($qry_exec_time)*1000);
		// if spend more time, save it in special file
		if($qry_exec_time_ms > 6000)
		{
			\dash\pdo\log::log($query_log, $qry_exec_time, 'log-hard-critical.sql');
		}
		elseif($qry_exec_time_ms > 3000)
		{
			\dash\pdo\log::log($query_log, $qry_exec_time, 'log-critical.sql');
		}
		elseif($qry_exec_time_ms > 1000)
		{
			\dash\pdo\log::log($query_log, $qry_exec_time, 'log-warn.sql');
		}
		elseif($qry_exec_time_ms > 500)
		{
			\dash\pdo\log::log($query_log, $qry_exec_time, 'log-check.sql');
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


		// give only one column of result
		if($result && $_column !== null)
		{
			if(is_array($_column))
			{
				// if pass 2 field use one as key and another as value of result
				if(count($_column) === 2 && isset($_column[0]) && isset($_column[1]))
				{
					$result_key   = array_column($result, $_column[0]);
					$result_value = array_column($result, $_column[1]);
					if($result_key && $result_value)
					{
						// for two field use array_combine
						$result = array_combine($result_key, $result_value);
					}
				}
				else
				{
					// need more than 2 field
				}

			}
			else
			{
				$result = array_column($result, $_column);
			}
		}

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
	 * Run multi query
	 */
	public static function multi_query($_query, $_param, $_db_fuel = null, $_options = [])
	{
		$result = false;

		foreach ($_query as $key => $value)
		{
			if(isset($_param[$key]))
			{
				$result = self::query($value, $_param[$key], $_db_fuel, $_options);
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
			$result = $link->beginTransaction();

			\dash\pdo\log::log_if_debug('START TRANSACTION');

			return $result;
		}
		catch (\Exception $e)
		{

			\dash\pdo\log::log_error($link->errorCode(), $e->getMessage());

			\dash\notif::error(T_("Can not start your request!"). ' T1001');

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
			$result = $link->commit();

			\dash\pdo\log::log_if_debug('COMMIT');

			return $result;
		}
		catch (\Exception $e)
		{

			\dash\pdo\log::log_error($link->errorCode(), $e->getMessage());

			\dash\notif::error(T_("Can not save your request!"). ' C1001');

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
			$result = $link->rollBack();

			\dash\pdo\log::log_if_debug('ROLLBACK');

			return $result;
		}
		catch (\Exception $e)
		{

			\dash\pdo\log::log_error($link->errorCode(), $e->getMessage());

			\dash\notif::error(T_("Can not close your request!"). ' R1001');

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

			\dash\pdo\log::log_error($link->errorCode(), $e->getMessage());

			\dash\notif::error(T_("Can not get id!"). ' I1001');

			return false;
		}



	}


	public static function close()
	{
		return \dash\pdo\connection::close();
	}

}
?>