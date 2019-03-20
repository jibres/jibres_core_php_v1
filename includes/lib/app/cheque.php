<?php
namespace lib\app;

/**
 * Class for cheque.
 */
class cheque
{
	public static $sort_field =
	[
		'bank_id',
		'date',
		'bank',
		'branch',
		'amount',
		'vajh',
		'owner',
		'getdate',
		'number',
		'type',
		'babat',
		'thirdparty',
		'desc',
		'status',

		'datecreated',
		'datemodified',
	];


	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = \lib\db\cheque::get(['id' => $id, 'limit' => 1]);
		$temp = [];
		if(is_array($result))
		{
			$temp = self::ready($result);
		}
		return $temp;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_id = null)
	{
		$bank = null;
		$bank_id = \dash\app::request('bank_id');
		if($bank_id)
		{
			$bank_id = \dash\coding::decode($bank_id);
			if(!$bank_id)
			{
				\dash\notif::error(T_("Invalid bank"), 'bank_id');
				return false;
			}

			$check = \lib\db\bank::get(['user_id' => \dash\user::id(), 'id' => $bank_id, 'limit' => 1]);
			if(!isset($check['id']))
			{
				\dash\notif::error(T_("Invalid bank"), 'bank_id');
				return false;
			}
		}
		else
		{
			$bank = \dash\app::request('bank');
			if(!$bank)
			{
				\dash\notif::error(T_("Please choose bank"), 'bank');
				return false;
			}

			if(mb_strlen($bank) > 150)
			{
				\dash\notif::error(T_("Please set bank name less than 150 character"), 'bank');
				return false;
			}
		}

		$chequebook_id = \dash\app::request('chequebook_id');
		if($chequebook_id)
		{
			$chequebook_id = \dash\coding::decode($chequebook_id);
			if(!$chequebook_id)
			{
				\dash\notif::error(T_("Invalid chequebook"), 'chequebook_id');
				return false;
			}

			$check = \lib\db\chequebook::get(['user_id' => \dash\user::id(), 'id' => $chequebook_id, 'limit' => 1]);
			if(!isset($check['id']))
			{
				\dash\notif::error(T_("Invalid chequebook"), 'chequebook_id');
				return false;
			}
		}

		$date = \dash\app::request('date');

		if($date)
		{
			$date = \dash\date::db($date);
			if($date === false)
			{
				\dash\notif::error(T_("Invalid date"), 'date');
				return false;
			}

			if(\dash\utility\jdate::is_jalali($date))
			{
				$date = \dash\utility\jdate::to_gregorian($date);
			}
		}

		if(!$date)
		{
			\dash\notif::error(T_("Please set cheque date"), 'date');
			return false;
		}

		$branch = \dash\app::request('branch');
		if($branch && mb_strlen($branch) > 150)
		{
			\dash\notif::error(T_("Please set branch name less than 150 character"), 'branch');
			return false;
		}

		$vajh = \dash\app::request('vajh');
		if($vajh && mb_strlen($vajh) > 150)
		{
			\dash\notif::error(T_("Please set vajh name less than 150 character"), 'vajh');
			return false;
		}


		$owner = \dash\app::request('owner');
		if($owner && mb_strlen($owner) > 150)
		{
			\dash\notif::error(T_("Please set owner name less than 150 character"), 'owner');
			return false;
		}


		$babat = \dash\app::request('babat');
		if($babat && mb_strlen($babat) > 150)
		{
			\dash\notif::error(T_("Please set babat name less than 150 character"), 'babat');
			return false;
		}


		$thirdparty = \dash\app::request('thirdparty');
		if($thirdparty && mb_strlen($thirdparty) > 150)
		{
			\dash\notif::error(T_("Please set thirdparty name less than 150 character"), 'thirdparty');
			return false;
		}


		$amount = \dash\app::request('amount');
		$amount = \dash\utility\convert::to_en_number($amount);
		if(!$amount)
		{
			\dash\notif::error(T_("Please set amount"), 'amount');
			return false;
		}

		if($amount && !is_numeric($amount))
		{
			\dash\notif::error(T_("Please set amount as a number"), 'amount');
			return false;
		}

		if($amount)
		{
			$amount = intval($amount);
			if($amount > 1E+20)
			{
				\dash\notif::error(T_("amount is out of range"), 'amount');
				return false;
			}
		}

		$number = \dash\app::request('number');
		$number = \dash\utility\convert::to_en_number($number);


		if($number && !is_numeric($number))
		{
			\dash\notif::error(T_("Please set number as a number"), 'number');
			return false;
		}

		if($number)
		{
			$number = intval($number);
			if($number > 1E+20)
			{
				\dash\notif::error(T_("number is out of range"), 'number');
				return false;
			}
		}

		$type        = \dash\app::request('type');
		if($type && !in_array($type, ['in', 'out']))
		{
			\dash\notif::error(T_("Invalid type"), 'type');
			return false;
		}


		$getdate = \dash\app::request('getdate');

		if($getdate)
		{
			$getdate = \dash\date::db($getdate);
			if($getdate === false)
			{
				\dash\notif::error(T_("Invalid getdate"), 'getdate');
				return false;
			}

			if(\dash\utility\jdate::is_jalali($getdate))
			{
				$getdate = \dash\utility\jdate::to_gregorian($getdate);
			}
		}

		$status        = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'deleted', 'expire', 'lost','useless', 'done']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$desc      = \dash\app::request('desc');


		$args                  = [];
		$args['bank_id']       = $bank_id;
		$args['chequebook_id'] = $chequebook_id;
		$args['bank']          = $bank;
		$args['date']          = $date;
		$args['branch']        = $branch;
		$args['vajh']          = $vajh;
		$args['owner']         = $owner;
		$args['babat']         = $babat;
		$args['thirdparty']    = $thirdparty;
		$args['amount']        = $amount;
		$args['number']        = $number;
		$args['type']          = $type;
		$args['getdate']       = $getdate;
		$args['status']        = $status;
		$args['desc']          = $desc;


		return $args;

	}


	public static function my_list()
	{
		return self::list();
	}

	/**
	 * ready data of user to load in api
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
				case 'bank_id':

				case 'chequebook_id':
					$result[$key] = \dash\coding::encode($value);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}


	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{
		\dash\app::variable($_args);


		$default_option =
		[
			'debug'    => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return  = [];

		if(!$args['status'])
		{
			$args['status'] = 'enable';
		}

		$args['user_id'] = \dash\user::id();

		$cheque = \lib\db\cheque::insert($args);

		if(!$cheque)
		{
			\dash\log::set('noWayToAddCheque');
			\dash\notif::error(T_("No way to insert cheque"));
			return false;
		}

		\dash\log::set('iAddCheque', ['code' => $cheque]);

		return $return;
	}


	public static function list($_string = null, $_args = [])
	{

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		$default_args =
		[
			'order' => null,
			'sort'  => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$option = [];
		$option = array_merge($default_args, $_args);

		if($option['order'])
		{
			if(!in_array($option['order'], ['asc', 'desc']))
			{
				unset($option['order']);
			}
		}

		if($option['sort'])
		{
			if(!in_array($option['sort'], self::$sort_field))
			{
				unset($option['sort']);
			}
		}


		$option['i_cheque.user_id'] = \dash\user::id();


		$result = \lib\db\cheque::search($_string, $option);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	public static function edit($_args, $_id)
	{
		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit cheque"), 'cheque');
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		// check args
		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('bank_id')) unset($args['bank_id']);
		if(!\dash\app::isset_request('chequebook_id')) unset($args['chequebook_id']);
		if(!\dash\app::isset_request('bank')) unset($args['bank']);
		if(!\dash\app::isset_request('date')) unset($args['date']);
		if(!\dash\app::isset_request('branch')) unset($args['branch']);
		if(!\dash\app::isset_request('vajh')) unset($args['vajh']);
		if(!\dash\app::isset_request('owner')) unset($args['owner']);
		if(!\dash\app::isset_request('babat')) unset($args['babat']);
		if(!\dash\app::isset_request('thirdparty')) unset($args['thirdparty']);
		if(!\dash\app::isset_request('amount')) unset($args['amount']);
		if(!\dash\app::isset_request('number')) unset($args['number']);
		if(!\dash\app::isset_request('type')) unset($args['type']);
		if(!\dash\app::isset_request('getdate')) unset($args['getdate']);
		if(!\dash\app::isset_request('status')) unset($args['status']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);

		if(!empty($args))
		{
			\lib\db\cheque::update($args, $id);
			\dash\log::set('iEditCheque', ['code' => $id]);
		}

		return true;
	}
}
?>