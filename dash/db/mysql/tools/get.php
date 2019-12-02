<?php
namespace dash\db\mysql\tools;

trait get
{

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
