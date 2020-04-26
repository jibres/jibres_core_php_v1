<?php
namespace lib\pardakhtyar\app;


class terminal
{

	public static $sort_field = [];

	public static function add($_args)
	{
		\dash\app::variable($_args);

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

		$args['creator']     = \dash\user::id();
		$args['datecreated'] = date("Y-m-d H:i:s");
		$return = [];

		$terminal_id = \lib\pardakhtyar\db\terminal::insert($args);

		if(!$terminal_id)
		{
			\dash\app::log('dbErrorCanNotAddTerminal');
			\dash\notif::error(T_("No way to insert Terminal"), 'db', 'system');
			return false;
		}

		$return['id'] = \dash\coding::encode($terminal_id);
		if(\dash\engine\process::status())
		{
			\dash\log::set('addNewTerminal', ['code' => $terminal_id]);
			\dash\notif::ok(T_("Terminal successfuly added"));
		}

		return $return;
	}


	public static function edit($_args, $_id)
	{
		\dash\app::variable($_args);

		$result = self::get($_id);

		$id = $_id;
		if(!$result)
		{
			return false;
		}

		// $id = \dash\coding::decode($_id);

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		if(!\dash\app::isset_request('sequence')) unset($args['sequence']);
		if(!\dash\app::isset_request('terminalNumber')) unset($args['terminalNumber']);
		if(!\dash\app::isset_request('terminalType')) unset($args['terminalType']);
		if(!\dash\app::isset_request('serialNumber')) unset($args['serialNumber']);
		if(!\dash\app::isset_request('setupDate')) unset($args['setupDate']);
		if(!\dash\app::isset_request('hardwareBrand')) unset($args['hardwareBrand']);
		if(!\dash\app::isset_request('hardwareModel')) unset($args['hardwareModel']);
		if(!\dash\app::isset_request('accessAddress')) unset($args['accessAddress']);
		if(!\dash\app::isset_request('accessPort')) unset($args['accessPort']);
		if(!\dash\app::isset_request('callbackAddress')) unset($args['callbackAddress']);
		if(!\dash\app::isset_request('callbackPort')) unset($args['callbackPort']);


		if(!empty($args))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");

			$update = \lib\pardakhtyar\db\terminal::update($args, $id);

			if(\dash\engine\process::status())
			{
				\dash\log::set('editTerminal', ['code' => $id,]);
				\dash\notif::ok(T_("Terminal successfully updated"));
			}
		}
	}



	public static function get($_id)
	{
		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("Terminal id not set"));
			return false;
		}

		$get = \lib\pardakhtyar\db\terminal::get(['id' => $_id, 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid Terminal id"));
			return false;
		}

		$result = self::ready($get);

		return $result;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_id = null)
	{

		$user_id = \dash\app::request('user_id');
		if($user_id && !is_numeric($user_id))
		{
			\dash\notif::error(T_("Invalid user id"), 'user_id');
			return false;
		}

		$customer_id = \dash\app::request('customer_id');
		if($customer_id && !is_numeric($customer_id))
		{
			\dash\notif::error(T_("Invalid user id"), 'customer_id');
			return false;
		}


		$sequence        = \dash\app::request('sequence');
		if($sequence && !is_numeric($sequence))
		{
			\dash\notif::error('sequence muset be a number', 'sequence');
			return false;
		}


		$terminalNumber  = \dash\app::request('terminalNumber');
		if($terminalNumber && mb_strlen($terminalNumber) !== 8)
		{
			\dash\notif::error('terminalNumber muset exacliy 8 character', 'terminalNumber');
			return false;
		}


		$terminalType    = \dash\app::request('terminalType');
		if(isset($terminalType) && is_numeric($terminalType) && in_array(intval($terminalType), [0,1,2,3]))
		{
			$terminalType = intval($terminalType);
		}


		$serialNumber    = \dash\app::request('serialNumber');
		if($serialNumber && mb_strlen($serialNumber) > 50)
		{
			\dash\notif::error('serialNumber is out of range', 'serialNumber');
			return false;
		}

		$setupDate       = \dash\app::request('setupDate');
		if($setupDate && !self::checkDateDb($setupDate))
		{
			\dash\notif::error("setupDate must be a timestamp", 'setupDate');
			return false;
		}


		$hardwareBrand   = \dash\app::request('hardwareBrand');
		if($hardwareBrand && mb_strlen($hardwareBrand) > 50)
		{
			\dash\notif::error('hardwareBrand is out of range', 'hardwareBrand');
			return false;
		}

		$hardwareModel   = \dash\app::request('hardwareModel');
		if($hardwareModel && mb_strlen($hardwareModel) > 50)
		{
			\dash\notif::error('hardwareModel is out of range', 'hardwareModel');
			return false;
		}

		$accessAddress   = \dash\app::request('accessAddress');
		if($accessAddress && mb_strlen($accessAddress) > 100)
		{
			\dash\notif::error('accessAddress is out of range! max 100', 'accessAddress');
			return false;
		}

		if($accessAddress && mb_strlen($accessAddress) < 7)
		{
			\dash\notif::error('accessAddress is out of range! min 7', 'accessAddress');
			return false;
		}

		$callbackAddress   = \dash\app::request('callbackAddress');
		if($callbackAddress && mb_strlen($callbackAddress) > 100)
		{
			\dash\notif::error('callbackAddress is out of range! max 100', 'callbackAddress');
			return false;
		}

		if($callbackAddress && mb_strlen($callbackAddress) < 7)
		{
			\dash\notif::error('callbackAddress is out of range! min 7', 'callbackAddress');
			return false;
		}


		$accessPort      = \dash\app::request('accessPort');
		if($accessPort && !is_numeric($accessPort))
		{
			\dash\notif::error('accessPort must be a number', 'accessPort');
			return false;
		}

		if($accessPort && intval($accessPort) > 99999)
		{
			\dash\notif::error('accessPort is out of range! max 99999', 'accessPort');
			return false;
		}

		if($accessPort && intval($accessPort) < 100)
		{
			\dash\notif::error('accessPort is out of range! min 100', 'accessPort');
			return false;
		}

		$callbackPort    = \dash\app::request('callbackPort');
		if($callbackPort && !is_numeric($callbackPort))
		{
			\dash\notif::error('callbackPort must be a number', 'callbackPort');
			return false;
		}

		if($callbackPort && intval($callbackPort) > 99999)
		{
			\dash\notif::error('callbackPort is out of range! max 99999', 'callbackPort');
			return false;
		}

		if($callbackPort && intval($callbackPort) < 100)
		{
			\dash\notif::error('callbackPort is out of range! min 100', 'callbackPort');
			return false;
		}



		$check_duplicate_args =
		[
			'customer_id' => $customer_id,
			'sequence'    => $sequence,
		];

		$check_duplicate = \lib\pardakhtyar\db\terminal::check_duplicate($check_duplicate_args, $_id);
		if(isset($check_duplicate['id']))
		{
			if(intval($check_duplicate['id']) === intval($_id))
			{
				// no problem to edit record
			}
			else
			{
				\dash\notif::error("This data is duplicate");
				return false;
			}
		}



		$args                    = [];
		$args['user_id']         = $user_id;
		$args['customer_id']     = $customer_id;
		$args['sequence']        = $sequence;
		$args['terminalNumber']  = $terminalNumber;
		$args['terminalType']    = $terminalType;
		$args['serialNumber']    = $serialNumber;
		$args['setupDate']       = $setupDate;
		$args['hardwareBrand']   = $hardwareBrand;
		$args['hardwareModel']   = $hardwareModel;
		$args['accessAddress']   = $accessAddress;
		$args['callbackAddress'] = $callbackAddress;
		$args['accessPort']      = $accessPort;
		$args['callbackPort']    = $callbackPort;


		return $args;
	}

	private static function checkDateDb($_date)
	{
		if(!$_date)
		{
			return null;
		}

		$_date = substr($_date, 0, 10);

		return \dash\date::db($_date);
	}




	// remove useless field to send to shaparak
	public static function ready_for_shaparak($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'setupDate':
					if($value)
					{
						$result[$key] =  (string) strtotime($value). '000';
					}
					else
					{
						$result[$key] = null;
					}
					// $result[$key] = "1567410970000";
					break;

				case 'sequence':
				case 'terminalNumber':
				case 'terminalType':
				case 'serialNumber':
				case 'hardwareBrand':
				case 'hardwareModel':
				case 'accessAddress':
				case 'accessPort':
				case 'callbackAddress':
				case 'callbackPort':
					$result[$key] = $value;
					break;

				case 'Description':
				default:
					// nothing
					break;
			}
		}

		return $result;
	}

	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				case 'birthCrtfctSeriesLetter':
				case 'vitalStatus':
				case 'residencyType':
				case 'gender':
				case 'terminalType':
					$fn = 'title_'. $key;
					$result[$key.'_title'] = \lib\pardakhtyar\type::$fn($value);
					$result[$key] = $value;
					break;
				case 'birthDate':
					$result[$key. '_title'] = \dash\datetime::fit($value, 'human');
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function list($_string, $_args)
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$default_meta =
		[
			'sort'  => null,
			'order' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}


		$result            = \lib\pardakhtyar\db\terminal::search($_string, $_args);
		$temp              = [];

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

}
?>