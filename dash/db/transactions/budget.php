<?php
namespace dash\db\transactions;


trait budget
{

	public static function calc_budget($_detail)
	{
		if(!isset($_detail['id']))
		{
			return false;
		}

		$user_as_unverify = false;

		if(array_key_exists('user_id', $_detail))
		{
			if($_detail['user_id'])
			{
				// no problem to continue;
			}
			else
			{
				// user id is null
				// pay as unverify
				$user_as_unverify = true;
			}
		}
		else
		{
			return false;
		}

		if(isset($_detail['type']) && isset($_detail['currency']))
		{
			// no problem to continue;
		}
		else
		{
			return false;
		}

		if($user_as_unverify)
		{
			$budget_before = 0;
		}
		else
		{
			$budget_before = self::budget($_detail['user_id']);
		}

		$budget_before           = floatval($budget_before);

		$budget                  = $budget_before + (floatval($_detail['plus']) - floatval($_detail['minus']));

		$update                  = [];
		$update['dateverify']    = time();
		$update['budget_before'] = $budget_before;
		$update['budget']        = $budget;

		return $update;
	}



	/**
	 * Get budget and lock table
	 *
	 * @param      <type>  $_user_id  The user identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function budget_get_lock($_user_id)
	{
		return self::budget($_user_id, true);
	}



	/**
	 * Calculate budget before special transaction id
	 *
	 * @param      <type>  $_user_id     The user identifier
	 * @param      <type>  $_special_id  The special identifier
	 */
	public static function budget_before_special_id($_user_id, $_special_id)
	{
		return self::budget($_user_id, false, ['calculate_before_id' => $_special_id]);
	}


	/**
	 * Primary function to calculate budget
	 *
	 * @param      <type>  $_user_id  The user identifier
	 * @param      bool    $_lock     The lock
	 * @param      array   $_options  The options
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function budget($_user_id, $_lock = false, $_options = [])
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$param            = [];
		$param[':userid'] = $_user_id;

		$lock = null;

		if($_lock)
		{
			$lock = ' FOR UPDATE ';
		}

		$calculate_before_id = null;
		if(isset($_options['calculate_before_id']) && is_numeric($_options['calculate_before_id']))
		{
			$calculate_before_id = ' AND transactions.id < :specialid ';
			$param[':specialid'] = $_options['calculate_before_id'];
		}

		$query =
		"
			SELECT (sum(IFNULL(transactions.plus,0)) - sum(IFNULL(transactions.minus,0))) as 'budget'
			FROM
				transactions
			WHERE
			transactions.user_id = :userid AND
			transactions.verify  = 1
			$calculate_before_id
			$lock
		";


		$budget = \dash\db::get_bind($query, $param, 'budget', true);

		$budget = floatval($budget);

		return $budget;
	}
}
?>
