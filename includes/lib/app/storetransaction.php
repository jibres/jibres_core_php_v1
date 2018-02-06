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


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_option = [])
	{

		$code = \lib\app::request('code');
		$code = trim($code);
		if($code && mb_strlen($code) >= 200)
		{
			\lib\debug::error(T_("Please set the code less than 200 character"), 'code');
			return false;
		}

		$title = \lib\app::request('title');
		$title = trim($title);
		if($title && mb_strlen($title) > 1E+4)
		{
			\lib\debug::error(T_("Title is out of range"), 'title');
			return false;
		}

		$type = \lib\app::request('type');
		if($type && mb_strlen($type) > 100)
		{
			\lib\debug::error(T_("Please set the type less thang 100 character"), 'type');
			return false;
		}

		$userstore_id = \lib\app::request('userstore_id');
		$userstore_id = \lib\utility\shortURL::decode($userstore_id);

		if(!$userstore_id && \lib\app::isset_request('userstore_id'))
		{
			\lib\debug::error(T_("Invalid userstore id"), 'userstore_id');
			return false;
		}

		$factor_id = \lib\app::request('factor_id');
		$factor_id = \lib\utility\shortURL::decode($factor_id);

		if(!$factor_id && \lib\app::isset_request('factor_id'))
		{
			\lib\debug::error(T_("Invalid userstore id"), 'factor_id');
			return false;
		}

		$plus = \lib\app::request('plus');
		$plus = \lib\utility\convert::to_en_number($plus);
		if($plus && !is_numeric($plus))
		{
			\lib\debug::error(T_("Amount must be a number"), 'plus');
			return false;
		}

		if($plus && intval($plus) > 1E+20)
		{
			\lib\debug::error(T_("Amount is out of range"), 'plus');
			return false;
		}

		if($plus && intval($plus) < 0)
		{
			\lib\debug::error(T_("Can not set amount less than zero"), 'plus');
			return false;
		}

		$minus = \lib\app::request('minus');
		$minus = \lib\utility\convert::to_en_number($minus);
		if($minus && !is_numeric($minus))
		{
			\lib\debug::error(T_("Amount must be a number"), 'minus');
			return false;
		}

		if($minus && intval($minus) > 1E+20)
		{
			\lib\debug::error(T_("Amount is out of range"), 'minus');
			return false;
		}

		if($minus && intval($minus) < 0)
		{
			\lib\debug::error(T_("Can not set amount less than zero"), 'minus');
			return false;
		}

		$duedate = \lib\app::request('duedate');
		if(\lib\app::isset_request('duedate') && $duedate)
		{
			$duedate = \lib\date::format($duedate, "Y-m-d H:i:s");
			if(!$duedate)
			{
				\lib\debug::error(T_("Invalid duedate"), 'duedate');
				return false;
			}
		}

		$status = \lib\app::request('status');
		if($status && !in_array($status, ['enable','disable','deleted','expired','awaiting','filtered','blocked','spam']))
		{
			\lib\debug::error(T_("Invalid status"), 'status');
			return false;
		}


		$operator = \lib\userstore::id();
		$date     = date("Y-m-d H:i:s");
		$fund_id  = null;
		$unit_id  = 1;
		$verify   = 1;

		$args                 = [];
		$args['code']         = $code;
		$args['title']        = $title;
		$args['type']         = $type;
		$args['userstore_id'] = $userstore_id;
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
						$result[$key] = \lib\utility\shortURL::encode($value);
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