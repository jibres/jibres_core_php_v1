<?php
namespace lib\app;

/**
 * Class for bank.
 */
class bank
{
	public static $sort_field =
	[
		'country',
		'bank',
		'title',
		'accountnumber',
		'shaba',
		'card',
		'branch',
		'branchcode',
		'owner',
		'iban',
		'nameoncard',
		'swift',
		'expire',
		'cvv2',
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

		$result = \lib\db\bank::get(['id' => $id, 'limit' => 1]);
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

		$country       = \dash\app::request('country');
		if($country && !\dash\utility\location\countres::check($country))
		{
			\dash\notif::error(T_("Invalid country"), 'country');
			return false;
		}



		$bank          = \dash\app::request('bank');
		if(!$bank)
		{
			\dash\notif::error(T_("Plese set bank name"), 'bank');
			return false;
		}

		if(mb_strlen($bank) > 150)
		{
			\dash\noitf::error(T_("Pleas set bank name less than 150 character"), 'bank');
			return false;
		}

		$title         = \dash\app::request('title');
		if($title && mb_strlen($title) > 150)
		{
			\dash\notif::error(T_("Please set title less than 150 character"), 'title');
			return false;
		}

		$accountnumber = \dash\app::request('accountnumber');
		if($accountnumber && mb_strlen($accountnumber) > 150)
		{
			\dash\notif::error(T_("Please set accountnumber less than 150 character"), 'accountnumber');
			return false;
		}

		$shaba         = \dash\app::request('shaba');
		if($shaba && mb_strlen($shaba) > 150)
		{
			\dash\notif::error(T_("Please set shaba less than 150 character"), 'shaba');
			return false;
		}

		$card          = \dash\app::request('card');
		if($card && mb_strlen($card) > 150)
		{
			\dash\notif::error(T_("Please set card less than 150 character"), 'card');
			return false;
		}

		$branch        = \dash\app::request('branch');
		if($branch && mb_strlen($branch) > 150)
		{
			\dash\notif::error(T_("Please set branch less than 150 character"), 'branch');
			return false;
		}

		$branchcode    = \dash\app::request('branchcode');
		if($branchcode && mb_strlen($branchcode) > 150)
		{
			\dash\notif::error(T_("Please set branchcode less than 150 character"), 'branchcode');
			return false;
		}

		$owner         = \dash\app::request('owner');
		if($owner && mb_strlen($owner) > 150)
		{
			\dash\notif::error(T_("Please set owner less than 150 character"), 'owner');
			return false;
		}

		$iban          = \dash\app::request('iban');
		if($iban && mb_strlen($iban) > 150)
		{
			\dash\notif::error(T_("Please set iban less than 150 character"), 'iban');
			return false;
		}

		$nameoncard    = \dash\app::request('nameoncard');
		if($nameoncard && mb_strlen($nameoncard) > 150)
		{
			\dash\notif::error(T_("Please set nameoncard less than 150 character"), 'nameoncard');
			return false;
		}

		$swift         = \dash\app::request('swift');
		if($swift && mb_strlen($swift) > 150)
		{
			\dash\notif::error(T_("Please set swift less than 150 character"), 'swift');
			return false;
		}


		$expire        = \dash\app::request('expire');
		if($expire && mb_strlen($expire) > 7)
		{
			\dash\notif::error(T_("Please set expire less than 7 character"), 'expire');
			return false;
		}

		$cvv2          = \dash\app::request('cvv2'); // ` varchar(10)CHARACTER SET utf8mb4 NULL DEFAULT NULL,
		if($cvv2 && mb_strlen($cvv2) > 8)
		{
			\dash\notif::error(T_("Please set cvv2 less than 8 character"), 'cvv2');
			return false;
		}

		$status        = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'deleted', 'expire', 'lost','useless']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$desc          = \dash\app::request('desc');

		$args                  = [];

		$args['country']       = $country;
		$args['bank']          = $bank;
		$args['title']         = $title;
		$args['accountnumber'] = $accountnumber;
		$args['shaba']         = $shaba;
		$args['card']          = $card;
		$args['branch']        = $branch;
		$args['branchcode']    = $branchcode;
		$args['owner']         = $owner;
		$args['iban']          = $iban;
		$args['nameoncard']    = $nameoncard;
		$args['swift']         = $swift;
		$args['expire']        = $expire;
		$args['cvv2']          = $cvv2;
		$args['status']        = $status;
		$args['desc']          = $desc;


		return $args;

	}



	/**
	 * ready data of user to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$_data = \dash\app::fix_avatar($_data);
		$result = [];
		$result['location_string'] = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'country':
					$result[$key] = $value;
					$result['country_name'] = \dash\utility\location\countres::get_localname($value, true);
					$result['location_string'][1] = $result['country_name'];
					break;


				case 'province':
					$result[$key] = $value;
					$result['province_name'] = \dash\utility\location\provinces::get_localname($value);
					$result['location_string'][2] = $result['province_name'];
					break;

				case 'city':
					$result[$key] = $value;
					$result['city_name'] = \dash\utility\location\cites::get_localname($value);
					$result['location_string'][3] = $result['city_name'];
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}
		ksort($result['location_string']);
		$result['location_string'] = array_filter($result['location_string']);
		$result['location_string'] = implode(T_(","). " ", $result['location_string']);

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

		$bank = \lib\db\bank::insert($args);

		if(!$bank)
		{
			\dash\log::set('noWayToAddBank');
			\dash\notif::error(T_("No way to insert bank"));
			return false;
		}

		\dash\log::set('iAddBank', ['code' => $bank]);

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


		$option['user_id'] = \dash\user::id();

		$result = \lib\db\bank::search($_string, $option);

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
			\dash\notif::error(T_("Can not access to edit bank"), 'bank');
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

		if(!\dash\app::isset_request('country')) unset($args['country']);
		if(!\dash\app::isset_request('bank')) unset($args['bank']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('accountnumber')) unset($args['accountnumber']);
		if(!\dash\app::isset_request('shaba')) unset($args['shaba']);
		if(!\dash\app::isset_request('card')) unset($args['card']);
		if(!\dash\app::isset_request('branch')) unset($args['branch']);
		if(!\dash\app::isset_request('branchcode')) unset($args['branchcode']);
		if(!\dash\app::isset_request('owner')) unset($args['owner']);
		if(!\dash\app::isset_request('iban')) unset($args['iban']);
		if(!\dash\app::isset_request('nameoncard')) unset($args['nameoncard']);
		if(!\dash\app::isset_request('swift')) unset($args['swift']);
		if(!\dash\app::isset_request('expire')) unset($args['expire']);
		if(!\dash\app::isset_request('cvv2')) unset($args['cvv2']);
		if(!\dash\app::isset_request('status')) unset($args['status']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);


		if(!empty($args))
		{
			\lib\db\bank::update($args, $id);
			\dash\log::set('iEditBank', ['code' => $id]);
		}

		return true;
	}
}
?>