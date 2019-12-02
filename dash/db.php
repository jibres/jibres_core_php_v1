<?php
namespace dash;

/** Create simple and clean connection to db **/
class db
{
	/**
	 * this library doing useful db actions
	 * v4.4
	 */
	use \dash\db\mysql\tools\backup;
	use \dash\db\mysql\tools\get;
	use \dash\db\mysql\tools\info;
	use \dash\db\mysql\tools\pagination;
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
}
?>