<?php
namespace dash;

/** Create simple and clean connection to db **/
class db
{

	/**
	 * run query string and return result
	 * now you don't need to check result
	 * @param  [type] $_qry [description]
	 * @return [type]       [description]
	 */
	public static function query($_qry, $_db_fuel = null, $_options = [])
	{

		$default_options =
		[
			// run mysqli_multi_query
			'multi_query'  => false,
			'database'     => null,
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
			'fuel'         => (is_string($_db_fuel) && $_db_fuel) ? $_db_fuel : null,
			'database'     => $_options['database'],
			'ignore_error' => $_options['ignore_error'],
		];

		\dash\db\mysql\tools\connection::connect($myDbFuel);

		// check the mysql link
		if(!\dash\db\mysql\tools\connection::link())
		{
			return null;
		}

		$have_error   = false;
		$error_code   = null;
		$error_string = null;

		/**
		 * send the query to mysql engine
		 */
		if($_options['multi_query'] === true)
		{
			$result = @mysqli_multi_query(\dash\db\mysql\tools\connection::link(), $_qry);

			// check the mysql result
			if(!is_a($result, 'mysqli_result') && !$result)
			{
				$have_error   = true;
				$error_code   = @mysqli_errno(\dash\db\mysql\tools\connection::link());
				$error_string = @mysqli_error(\dash\db\mysql\tools\connection::link());
			}

			if($result)
			{
				do
				{
					if ($r = mysqli_use_result(\dash\db\mysql\tools\connection::link()))
					{
						$r->close();
					}

					if (!mysqli_more_results(\dash\db\mysql\tools\connection::link()))
					{
						break;
					}

					mysqli_more_results(\dash\db\mysql\tools\connection::link());
				}
				while (mysqli_next_result(\dash\db\mysql\tools\connection::link()));
			}
		}
		else
		{
			$result = @mysqli_query(\dash\db\mysql\tools\connection::link(), $_qry);

			// check the mysql result
			if(!is_a($result, 'mysqli_result') && !$result)
			{
				$have_error   = true;
				$error_code   = @mysqli_errno(\dash\db\mysql\tools\connection::link());
				$error_string = @mysqli_error(\dash\db\mysql\tools\connection::link());
			}
		}

		// get diff of time after exec
		$qry_exec_time = microtime(true) - $qry_exec_time;

		// if debug mod is true save all string query
		if(\dash\engine\error::debug_mode() && !\dash\temp::get('force_stop_query_log'))
		{
			\dash\db\mysql\tools\log::log($_qry, $qry_exec_time);
		}
		// calc exex time in ms
		$qry_exec_time_ms = round($qry_exec_time*1000);
		// if spend more time, save it in special file
		if($qry_exec_time_ms > 3000)
		{
			\dash\db\mysql\tools\log::log($_qry, $qry_exec_time, 'log-critical.sql');
		}
		elseif($qry_exec_time_ms > 1000)
		{
			\dash\db\mysql\tools\log::log($_qry, $qry_exec_time, 'log-warn.sql');
		}
		elseif($qry_exec_time_ms > 500)
		{
			\dash\db\mysql\tools\log::log($_qry, $qry_exec_time, 'log-check.sql');
		}

		if($have_error)
		{
			// no result exist
			// save mysql error
			$temp_error = "#". date("Y-m-d H:i:s") ;
			$temp_error .= "\n$_qry\n/* \tMYSQL ERROR\n";
			$temp_error .= $error_code. ' - ';
			$temp_error .= $error_string." */";

			// $temp_error .= @mysqli_errno(\dash\db\mysql\tools\connection::link()). ' - ';
			// $temp_error .= @mysqli_error(\dash\db\mysql\tools\connection::link())." */";
			\dash\db\mysql\tools\log::log($temp_error, $qry_exec_time, 'error.sql');

			if(\dash\url::isLocal())
			{
				\dash\notif::warn(nl2br($temp_error));
			}

			return false;
		}

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
		$last_id = @mysqli_insert_id($_link);
		return $last_id;
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
}
?>