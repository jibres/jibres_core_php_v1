<?php
namespace dash;

/** Create simple and clean connection to db **/
class db
{
	/**
	 * this library doing useful db actions
	 * v4.4
	 */


	use \dash\db\mysql\tools\info;
	use \dash\db\mysql\tools\log;


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
			'multi_query' => false,
			'database'    => null,
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
			'fuel'     => (is_string($_db_fuel) && $_db_fuel) ? $_db_fuel : null,
			'database' => $_options['database'],
		];

		\dash\db\mysql\tools\connection::connect($myDbFuel);


		// check the mysql link
		if(!\dash\db\mysql\tools\connection::link())
		{
			return null;
		}


		// to fix: mysql server has gone away!
		// if(!@mysqli_ping(\dash\db\mysql\tools\connection::link()))
		// {
		// 	self::close();

		// 	$temp_error = "#". date("Y-m-d H:i:s") . "\n$_qry\n/* ERROR\tMYSQL ERROR\n". @mysqli_error(\dash\db\mysql\tools\connection::link())." */";

		// 	self::log($temp_error, $qry_exec_time, 'gone-away.sql');

		// 	self::connect($_db_fuel);

		// 	if(!@mysqli_ping(\dash\db\mysql\tools\connection::link()))
		// 	{
		// 		$temp_error = "#". date("Y-m-d H:i:s") . "/* AFTER CONNECTION AGAIN! \n ERROR\tMYSQL ERROR\n". @mysqli_error(\dash\db\mysql\tools\connection::link())." */";
		// 		self::log($temp_error, $qry_exec_time, 'gone-away.sql');
		// 		return false;
		// 	}
		// }
		/**
		 * send the query to mysql engine
		 */
		if($_options['multi_query'] === true)
		{
			$result = @mysqli_multi_query(\dash\db\mysql\tools\connection::link(), $_qry);
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
			$result = mysqli_query(\dash\db\mysql\tools\connection::link(), $_qry);
		}

		// get diff of time after exec
		$qry_exec_time = microtime(true) - $qry_exec_time;

		// if debug mod is true save all string query
		if(\dash\option::config('debug'))
		{
			self::log($_qry, $qry_exec_time);
		}
		// calc exex time in ms
		$qry_exec_time_ms = round($qry_exec_time*1000);
		// if spend more time, save it in special file
		if($qry_exec_time_ms > 3000)
		{
			self::log($_qry, $qry_exec_time, 'log-critical.sql');
		}
		elseif($qry_exec_time_ms > 1000)
		{
			self::log($_qry, $qry_exec_time, 'log-warn.sql');
		}
		elseif($qry_exec_time_ms > 500)
		{
			self::log($_qry, $qry_exec_time, 'log-check.sql');
		}


		// check the mysql result
		if(!is_a($result, 'mysqli_result') && !$result)
		{
			// no result exist
			// save mysql error
			$temp_error = "#". date("Y-m-d H:i:s") . "\n$_qry\n/* ERROR\tMYSQL ERROR\n". mysqli_error(\dash\db\mysql\tools\connection::link())." */";
			self::log($temp_error, $qry_exec_time, 'error.sql');

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
	 * transaction
	 */
	public static function transaction($_db_name = true)
	{
		return self::query("START TRANSACTION", $_db_name);
	}


	/**
	 * commit
	 */
	public static function commit($_db_name = true)
	{
		return self::query("COMMIT", $_db_name);
	}


	/**
	 * rollback
	 */
	public static function rollback($_db_name = true)
	{
		return self::query("ROLLBACK", $_db_name);
	}


	/**
	 * run query and get result of this query
	 * @param  [type]  $_qry          [description]
	 * @param  [type]  $_column       [description]
	 * @param  boolean $_onlyOneValue [description]
	 * @return [type]                 [description]
	 */
	public static function get($_qry, $_column = null, $_onlyOneValue = false, $_db_name = true)
	{
		// generate query and get result
		$result = self::query($_qry, $_db_name);
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
}
?>