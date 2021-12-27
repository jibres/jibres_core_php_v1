<?php
namespace dash\db;


/** transactions managing **/
class transactions
{

	use \dash\db\transactions\set;
	use \dash\db\transactions\budget;
	use \dash\db\transactions\total_paid;


	public static function final_verify($_transaction_id)
	{
		// not need in DASH!
		// this function run in some project
		// to set the verified transactio in other table
		return true;
	}

	/**
	 * insert new record of transactions
	 *
	 * @param      <type>  $_arg   The argument
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function insert($_args)
	{
		if(a($_args, 'status') === null)
		{
			$_args['status'] = 'enable';
		}

		return \dash\pdo\query_template::insert('transactions', $_args);
	}


	public static function get_count()
	{
		return \dash\pdo\query_template::get_count('transactions', ...func_get_args());
	}

	/**
	 * update transactions
	 *
	 * @param      <type>  $_args  The arguments
	 * @param      <type>  $_id    The identifier
	 */
	public static function update()
	{
		return \dash\pdo\query_template::update('transactions', ...func_get_args());
	}


	public static function load($_token)
	{
		if(!$_token)
		{
			return false;
		}

		$query =
		"
			SELECT
				transactions.*,
				users.displayname AS `displayname`
			FROM
				transactions
			LEFT JOIN users ON users.id = transactions.user_id
			WHERE
				transactions.token = '$_token'
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function load_banktoken_transaction_id($_token, $_banktoken_transaction_id, $_bank)
	{
		if(!$_token || !$_bank)
		{
			return false;
		}

		$query =
		"
			SELECT
				transactions.*,
				users.displayname AS `displayname`
			FROM
				transactions
			LEFT JOIN users ON users.id = transactions.user_id
			WHERE
				transactions.token   = '$_token' AND
				transactions.id      = '$_banktoken_transaction_id' AND
				transactions.payment = '$_bank'
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function load_banktoken($_token, $_banktoken, $_bank)
	{
		if(!$_token || !$_bank)
		{
			return false;
		}

		$query =
		"
			SELECT
				transactions.*,
				users.displayname AS `displayname`
			FROM
				transactions
			LEFT JOIN users ON users.id = transactions.user_id
			WHERE
				transactions.token     = '$_token' AND
				transactions.banktoken = '$_banktoken' AND
				transactions.payment   = '$_bank'
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}



	public static function load_multi_id($_ids)
	{
		$query = "SELECT * FROM transactions WHERE transactions.id IN ($_ids) ";
		$result = \dash\pdo::get($query);
		return $result;
	}





	/**
	 * change some field to show
	 *
	 * @param      <type>  $_result  The result
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function ready($_result, $_multi_record = false)
	{
		if($_result && is_array($_result))
		{
			if($_multi_record)
			{
				foreach ($_result as $key => $value)
				{
					if(isset($value['code']))
					{
						$_result[$key]['code'] = self::get_caller($value['code']);
					}
				}
			}
			else
			{
				if(isset($_result['code']))
				{
					$_result['code'] = self::get_caller($_result['code']);
				}
			}
		}
		return $_result;
	}
}
?>
