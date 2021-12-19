<?php
namespace dash;

/** Create simple and clean connection to db **/
class db
{

	/**
	 * If mysql gone away reset connection and try again
	 *
	 * @var        boolean
	 */
	private static $connection_again = false;


	/**
	 * In some error need to execute query again
	 *
	 * @var        bool
	 */
	private static $execute_query_again = false;


	/**
	 * run query string and return result
	 * now you don't need to check result
	 * @param  [type] $_qry [description]
	 * @return [type]       [description]
	 */
	public static function query($_qry, $_db_fuel = null, $_options = [])
	{
		$fn_args = func_get_args();

		\dash\notif::turn_off_log();

		$default_options =
		[
			// run mysqli_multi_query
			'multi_query'  => false,
			'database'     => null,
			'bind'         => null, // buind query
			// if have error in connection or anything ignore it and return false
			'ignore_error' => false,
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

		\dash\db\mysql\tools\connection::connect($myDbFuel);

		$link = \dash\db\mysql\tools\connection::link();
		// check the mysql link
		if(!$link)
		{
			\dash\notif::turn_on_log();
			return null;
		}

		$have_error    = false;
		$error_code    = null;
		$error_string  = null;
		$buind_success = false;
		$is_bind       = false;


		// bind query
		if($_options['bind'] && is_array($_options['bind']))
		{
			$is_bind = true;

			$param     = $_options['bind'];

			$ready_param = [];

			$bind_types = '';

			// sort args by position of query string
			$sort_param = [];

			foreach ($param as $key => $value)
			{
				$strpos = \dash\str::strpos($_qry, $key);

				if($strpos === false)
				{
					continue;
				}

				$sort_param[$strpos] = $key;
			}

			ksort($sort_param);

			$new_param = [];

			foreach ($sort_param as $param_key)
			{
				if(array_key_exists($param_key, $param))
				{
					$new_param[$param_key] = $param[$param_key];
				}
			}

			foreach ($new_param as $key => $value)
			{
				$value_is_array = false;

				$temp_bind_type = self::get_stmt_type($value);

				if(is_string($temp_bind_type))
				{
					$bind_types .= $temp_bind_type;
				}
				elseif(is_array($temp_bind_type))
				{
					$value_is_array = true;

					foreach ($value as $sub_value)
					{
						$temp_bind_sub_type = self::get_stmt_type($sub_value);

						if(is_string($temp_bind_sub_type))
						{
							$bind_types .= $temp_bind_sub_type;
						}
						elseif(is_array($temp_bind_type))
						{
							trigger_error('db param key array error 1');
							return false;
						}
					}
				}
				else
				{
					trigger_error('db param key array error 2');
					return false;
				}

				if($value_is_array)
				{
					$repeat        = str_repeat('?,', count($value) - 1) . '?';
					$_qry          = str_replace($key, $repeat, $_qry);

					foreach ($value as $sub_value)
					{
						$ready_param[] = $sub_value;
					}
				}
				else
				{
					$_qry          = str_replace($key, '?', $_qry);
					$ready_param[] = $value;
				}
			}

			$result = false;

			$stmt = \mysqli_prepare($link, $_qry);

			if($stmt)
			{
				@mysqli_stmt_bind_param($stmt, $bind_types, ...$ready_param);

				@mysqli_stmt_execute($stmt);

				$result = @$stmt->get_result();
			}


			// check the mysql result
			if(!is_a($result, 'mysqli_result') && !$result && @mysqli_error($link))
			{
				$have_error   = true;
				$error_code   = @mysqli_errno($link);
				$error_string = @mysqli_error($link);

				// 1615 - Prepared statement needs to be re-prepared
				if(intval($error_code) === 1615)
				{
					if(!self::$execute_query_again)
					{
						self::$execute_query_again = true;

						// // close connection to run again
						// \dash\db\mysql\tools\connection::close();

						// run query again
						return self::query(...func_get_args());
					}
				}
			}

		}
		else
		{
			/**
			 * send the query to mysql engine
			 */
			if($_options['multi_query'] === true)
			{
				$result = @mysqli_multi_query($link, $_qry);

				// check the mysql result
				if(!is_a($result, 'mysqli_result') && !$result)
				{
					$have_error   = true;
					$error_code   = @mysqli_errno($link);
					$error_string = @mysqli_error($link);
				}

				if($result)
				{
					do
					{
						if ($r = mysqli_use_result($link))
						{
							$r->close();
						}

						if (!mysqli_more_results($link))
						{
							break;
						}

						mysqli_more_results($link);
					}
					while (mysqli_next_result($link));
				}
			}
			else
			{
				$result = @mysqli_query($link, $_qry);

				// check the mysql result
				if(!is_a($result, 'mysqli_result') && !$result)
				{
					$have_error   = true;
					$error_code   = @mysqli_errno($link);
					$error_string = @mysqli_error($link);
				}
			}
		}

		$save_query = $_qry;

		if($is_bind)
		{
			$save_query = 'BIND; '. $save_query;
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
				$temp = $save_query . ' -- '. \dash\db\mysql\tools\connection::get_last_fuel_detail();
				$temp .= '-- '. json_encode($fn_args);

				\dash\db\mysql\tools\log::log($temp, $qry_exec_time);
			}
		}
		// calc exex time in ms
		$qry_exec_time_ms = round($qry_exec_time*1000);
		// if spend more time, save it in special file
		if($qry_exec_time_ms > 6000)
		{
			\dash\db\mysql\tools\log::log($save_query, $qry_exec_time, 'log-hard-critical.sql');
		}
		elseif($qry_exec_time_ms > 3000)
		{
			\dash\db\mysql\tools\log::log($save_query, $qry_exec_time, 'log-critical.sql');
		}
		elseif($qry_exec_time_ms > 1000)
		{
			\dash\db\mysql\tools\log::log($save_query, $qry_exec_time, 'log-warn.sql');
		}
		elseif($qry_exec_time_ms > 500)
		{
			\dash\db\mysql\tools\log::log($save_query, $qry_exec_time, 'log-check.sql');
		}

		if($have_error)
		{
			// no result exist
			// save mysql error
			$temp_error = "#". date("Y-m-d H:i:s") ;
			$temp_error .= "\n$save_query\n/* \tMYSQL ERROR\n";
			$temp_error .= $error_code. ' - ';
			$temp_error .= $error_string." */";
			$temp_error .= ' -- '. \dash\db\mysql\tools\connection::get_last_fuel_detail();
			$temp_error .= ' -- '. json_encode($fn_args);

			// General error: 2006 MySQL server has gone away
			// Error Code: 2013. Lost connection to MySQL server during query

			if(intval($error_code) === 2006 || intval($error_code) === 2013)
			{
				if(self::$connection_again)
				{
					\dash\db\mysql\tools\log::log("Mysql Error 2006 after connection again  -- ", $qry_exec_time, 'error.sql');
				}
				else
				{
					self::$connection_again = true;

					\dash\db\mysql\tools\connection::close();
					// run query again
					return self::query(...func_get_args());
				}
			}

			if(!$error_code && !$error_string && \dash\url::content() === 'hook')
			{
				// @Reza @Javad Need to fix Cronjob error null sql
				// At this time I disable the log of null sql error to check other error
				\dash\db\mysql\tools\log::log($temp_error, $qry_exec_time, 'error_cronjob.sql');
			}
			else
			{
				// $temp_error .= @mysqli_errno(\dash\db\mysql\tools\connection::link()). ' - ';
				// $temp_error .= @mysqli_error(\dash\db\mysql\tools\connection::link())." */";
				\dash\db\mysql\tools\log::log($temp_error, $qry_exec_time, 'error.sql');
			}

			if(\dash\url::isLocal())
			{
				\dash\notif::warn(nl2br($temp_error));
			}

			\dash\notif::turn_on_log();

			return false;
		}

		\dash\notif::turn_on_log();

		// query ok. ready for next query if have error 2006
		self::$connection_again = false;

		// return the mysql result
		return $result;
	}


	private static function get_stmt_type($_value)
	{
		if(is_int($_value))
		{
			$type = 'i';
		}
		elseif(is_float($_value))
		{
			$type = 'd';
		}
		elseif(is_string($_value))
		{
			$type = 's';
		}
		elseif(is_numeric($_value))
		{
			$type = 's';
		}
		elseif(is_null($_value))
		{
			$type = 's';
		}
		elseif(is_bool($_value))
		{
			$type = 'b';
		}
		elseif(is_array($_value))
		{
			return [];
		}
		else
		{
			$type = 's';
		}

		return $type;

	}


	/**
	 * Gets the bind.
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     <type>  The bind.
	 */
	public static function get_bind($_query, $_param = [], $_column = null, $_onlyOneValue = false, $_db_fuel = true, $_options = [])
	{
		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options['bind']         = $_param;

		return self::get($_query, $_column, $_onlyOneValue, $_db_fuel, $_options);
	}


	/**
	 * Queries a bind.
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */

	public static function query_bind($_query, $_param = [], $_db_fuel = null, $_options = [])
	{
		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options['bind']         = $_param;

		return self::query($_query, $_db_fuel, $_options);
	}




	/**
	 * run query and get result of this query
	 * @param  [type]  $_qry          [description]
	 * @param  [type]  $_column       [description]
	 * @param  boolean $_onlyOneValue [description]
	 * @return [type]                 [description]
	 */
	public static function get($_qry, $_column = null, $_onlyOneValue = false, $_db_fuel = true, $_options = [])
	{
		// generate query and get result
		$result = self::query($_qry, $_db_fuel, $_options);
		// fetch datatable by result


		$result = self::fetch_all($result, $_column);
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
	 * Safe value for query string
	 *
	 * @param      <type>  $_string  The string
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function safe($_string)
	{
		if(!\dash\db\mysql\tools\connection::link())
		{
			if(\dash\url::isLocal())
			{
				\dash\notif::warn('No connection to safe mysqli_real_escape_string');
			}

			return addslashes($_string);
		}

		return \mysqli_real_escape_string(\dash\db\mysql\tools\connection::link(), $_string);
	}


	/**
	 * transaction
	 */
	public static function transaction($_db_fuel = true)
	{
		return self::query("START TRANSACTION", $_db_fuel);
	}


	/**
	 * commit
	 */
	public static function commit($_db_fuel = true)
	{
		return self::query("COMMIT", $_db_fuel);
	}


	/**
	 * rollback
	 */
	public static function rollback($_db_fuel = true)
	{
		return self::query("ROLLBACK", $_db_fuel);
	}


	/**
	 * fetch all row from database
	 * @param  [type] $_result    [description]
	 * @param  [type] $resulttype [description]
	 * @return [type]             [description]
	 */
	public static function fetch_all($_result, $_field = null, $resulttype = MYSQLI_ASSOC)
	{
		$result = [];
		// if mysqli fetch all is exist use it
		if(is_a($_result, 'mysqli_result'))
		{
			if(function_exists('mysqli_fetch_all'))
			{
				$result = @mysqli_fetch_all($_result, $resulttype);
			}
			else
			{
				for (; $tmp = $_result->fetch_array($resulttype);)
				{
					$result[] = $tmp;
				}
			}
		}

		// give only one column of result
		if($result && $_field !== null)
		{
			if(is_array($_field))
			{
				// if pass 2 field use one as key and another as value of result
				if(count($_field) === 2 && isset($_field[0]) && isset($_field[1]))
				{
					$result_key   = array_column($result, $_field[0]);
					$result_value = array_column($result, $_field[1]);
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
				$result = array_column($result, $_field);
			}
		}
		// return result
		return $result;
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
			$_link = \dash\db\mysql\tools\connection::link();
		}

		if(!$_link)
		{
			return false;
		}

		$last_id = @mysqli_insert_id($_link);
		return $last_id;
	}


	public static function close()
	{
		\dash\db\mysql\tools\connection::close();
		\dash\pdo\connection::close();
	}


}
?>