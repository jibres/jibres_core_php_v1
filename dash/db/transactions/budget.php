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


	public static function budget_get_lock($_user_id)
	{
		return self::budget($_user_id, true);
	}


	public static function budget($_user_id, $_lock = false)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$lock = null;

		if($_lock)
		{
			$lock = ' FOR UPDATE ';
		}

		$query =
		"
			SELECT (sum(IFNULL(transactions.plus,0)) - sum(IFNULL(transactions.minus,0))) as 'budget'
			FROM
				transactions
			WHERE
			transactions.user_id = $_user_id AND
			transactions.verify  = 1
			$lock
		";


		$budget = floatval(\dash\db::get($query, 'budget', true));

		return $budget;
	}
}
?>
