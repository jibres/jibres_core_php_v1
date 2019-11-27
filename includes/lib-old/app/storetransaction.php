<?php
namespace lib\app;


/**
 * Class for storetransaction.
 */
class storetransaction
{

	use \lib\app\storetransaction\add;
	use \lib\app\storetransaction\edit;
	use \lib\app\storetransaction\get;
	use \lib\app\storetransaction\datalist;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_option = [])
	{

		$user_id = \dash\app::request('user_id');
		$user_id = \dash\coding::decode($user_id);
		if(!$user_id && \dash\app::isset_request('user_id'))
		{
			\dash\notif::error(T_("Invalid userstore id"), 'user_id');
			return false;
		}

		if(!$user_id) $user_id = null;


		$plus = \dash\app::request('plus');
		$plus = str_replace(',', '', $plus);
		$plus = \dash\utility\convert::to_en_number($plus);
		if($plus && !is_numeric($plus))
		{
			\dash\notif::error(T_("Amount must be a number"), 'plus');
			return false;
		}

		if($plus && intval($plus) > 1E+20)
		{
			\dash\notif::error(T_("Amount is out of range"), 'plus');
			return false;
		}

		if($plus && intval($plus) < 0)
		{
			\dash\notif::error(T_("Can not set amount less than zero"), 'plus');
			return false;
		}

		$minus = \dash\app::request('minus');
		$minus = str_replace(',', '', $minus);
		$minus = \dash\utility\convert::to_en_number($minus);
		if($minus && !is_numeric($minus))
		{
			\dash\notif::error(T_("Amount must be a number"), 'minus');
			return false;
		}

		if($minus && intval($minus) > 1E+20)
		{
			\dash\notif::error(T_("Amount is out of range"), 'minus');
			return false;
		}

		if($minus && intval($minus) < 0)
		{
			\dash\notif::error(T_("Can not set amount less than zero"), 'minus');
			return false;
		}

		$subtitle = \dash\app::request('subtitle');
		$subtitle = trim($subtitle);
		if($subtitle && mb_strlen($subtitle) >= 200)
		{
			\dash\notif::error(T_("Please set the subtitle less than 200 character"), 'subtitle');
			return false;
		}

		$code = \dash\app::request('code');
		$code = trim($code);
		if($code && mb_strlen($code) >= 200)
		{
			\dash\notif::error(T_("Please set the code less than 200 character"), 'code');
			return false;
		}

		$title = \dash\app::request('title');
		$title = trim($title);
		if($title && mb_strlen($title) > 1E+4)
		{
			\dash\notif::error(T_("Title is out of range"), 'title');
			return false;
		}

		$type = \dash\app::request('type');
		if($type && mb_strlen($type) > 100)
		{
			\dash\notif::error(T_("Please set the type less thang 100 character"), 'type');
			return false;
		}

		$duedate = \dash\app::request('duedate');
		if(\dash\app::isset_request('duedate') && $duedate)
		{
			$duedate = \dash\date::format($duedate, "Y-m-d H:i:s");
			if(!$duedate)
			{
				\dash\notif::error(T_("Invalid duedate"), 'duedate');
				return false;
			}
		}

		$status = \dash\app::request('status');
		if($status && !in_array($status, ['enable','disable','deleted','expired','awaiting','filtered','blocked','spam']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$factor_id = \dash\app::request('factor_id');
		$factor_id = \dash\coding::decode($factor_id);
		if(!$factor_id && \dash\app::isset_request('factor_id'))
		{
			\dash\notif::error(T_("Invalid userstore id"), 'factor_id');
			return false;
		}

		if($factor_id)
		{
			// check type of pay factor
			if($type && !in_array($type, ['cash', 'check', 'pos']))
			{
				\dash\notif::error(T_("Invalid type of factor pay"), 'type');
				return false;
			}

			// load factor detail
			$factor_detail = \lib\db\factors::get(['id' => $factor_id, 'store_id' => \lib\store::id(), 'limit' => 1]);
			if(!$factor_detail || !array_key_exists('type', $factor_detail) || !array_key_exists('sum', $factor_detail))
			{
				\dash\notif::error(T_("Invalid factor id"));
				return false;
			}

			// get customer from factor
			if(isset($factor_detail['customer']))
			{
				$user_id = $factor_detail['customer'];
			}
			else
			{
				$user_id = null;
			}

			$amount = \dash\app::request('amount');
			$amount = str_replace(',', '', $amount);
			$amount = \dash\utility\convert::to_en_number($amount);

			if(!$amount)
			{
				\dash\notif::error(T_("Please set the amount"), 'amount');
				return false;
			}

			if($amount && !is_numeric($amount))
			{
				\dash\notif::error(T_("Amount must be a number"), 'amount');
				return false;
			}

			if($amount && intval($amount) > 1E+20)
			{
				\dash\notif::error(T_("Amount is out of range"), 'amount');
				return false;
			}

			if($amount && intval($amount) < 0)
			{
				\dash\notif::error(T_("Can not set amount less than zero"), 'amount');
				return false;
			}

			if($amount)
			{
				$amount = intval($amount);
			}

			if(isset($factor_detail['pay']) && intval($factor_detail['pay']) === 1)
			{
				\dash\notif::error(T_("This factor was payed before. can not add another pay for this factor"));
				return false;
			}

			$load_saved_transactions = \lib\db\storetransactions::get(['factor_id' => $factor_id]);
			$saved_amount            = 0;

			if(is_array($load_saved_transactions))
			{
				$temp         = array_column($load_saved_transactions, 'plus');
				$temp         = array_sum($temp);
				$saved_amount = intval($temp);
			}

			$saved_amount = $saved_amount + $amount;

			$factor_sum = intval($factor_detail['sum']);

			$factor_pay = false;

			if($factor_sum > $saved_amount)
			{
				// no thing
			}
			elseif($factor_sum < $saved_amount)
			{
				if(!$user_id)
				{
					\dash\notif::error(T_("Can not set amount larger than factor sum when no customer selected"), 'amount');
					return false;
				}
				$factor_pay = true;
			}
			elseif($factor_sum === $saved_amount)
			{
				$factor_pay = true;
			}

			if($factor_pay)
			{
				\lib\db\factors::update(['pay' => 1], $factor_detail['id']);
			}

			switch ($factor_detail['type'])
			{
				case 'sale':
					$plus = $amount;
					break;

				case 'buy':
					$minus = $amount;
					break;

				default:
					\dash\notif::error(T_("Invalid factor type"));
					return false;
					break;
			}

			$bank = \dash\app::request('bank');
			if($bank && mb_strlen($bank) > 150)
			{
				\dash\notif::error(T_("Value of bank is out of range"), 'bank');
				return false;
			}
			// set pos name in subtitle of storetransaction
			if($bank && $type === 'pos')
			{
				$subtitle = $bank;
			}
		}

		$operator = \lib\userstore::id();
		$date     = date("Y-m-d H:i:s");
		$fund_id  = null;
		$unit_id  = 1;
		$verify   = 1;

		$args                 = [];
		$args['code']         = $code;
		$args['subtitle']     = $subtitle;
		$args['title']        = $title;
		$args['type']         = $type;
		$args['user_id'] = $user_id;
		$args['operator']     = $operator;
		$args['fund_id']      = $fund_id;
		$args['factor_id']    = $factor_id;
		$args['plus']         = $plus;
		$args['minus']        = $minus;
		$args['unit_id']      = $unit_id;
		$args['date']         = $date;
		$args['verify']       = $verify;
		$args['duedate']      = $duedate;

		return $args;
	}


	/**
	 * ready data of storetransaction to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'store_id':
				case 'customer':
				case 'seller':
				case 'creator':

					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'datecreated':
				case 'datemodified':
					continue;
					break;

				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}
}
?>