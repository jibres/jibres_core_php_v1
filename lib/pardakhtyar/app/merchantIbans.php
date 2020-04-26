<?php
namespace lib\pardakhtyar\app;


class merchantIbans
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

		$merchantIbans_id = \lib\pardakhtyar\db\merchantIbans::insert($args);

		if(!$merchantIbans_id)
		{
			\dash\app::log('dbErrorCanNotAddMerchantIbans');
			\dash\notif::error(T_("No way to insert MerchantIbans"), 'db', 'system');
			return false;
		}

		$return['id'] = \dash\coding::encode($merchantIbans_id);
		if(\dash\engine\process::status())
		{
			\dash\log::set('addNewMerchantIbans', ['code' => $merchantIbans_id]);
			\dash\notif::ok(T_("MerchantIbans successfuly added"));
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


		if(!\dash\app::isset_request('user_id')) unset($args['user_id']);
		if(!\dash\app::isset_request('customer_id')) unset($args['customer_id']);
		if(!\dash\app::isset_request('merchantIban')) unset($args['merchantIban']);

		if(!empty($args))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");

			$update = \lib\pardakhtyar\db\merchantIbans::update($args, $id);

			if(\dash\engine\process::status())
			{
				\dash\log::set('editMerchantIbans', ['code' => $id,]);
				\dash\notif::ok(T_("MerchantIbans successfully updated"));
			}
		}
	}



	public static function get($_id)
	{
		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("MerchantIbans id not set"));
			return false;
		}

		$get = \lib\pardakhtyar\db\merchantIbans::get(['id' => $_id, 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid MerchantIbans id"));
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

		$merchantIban = \dash\app::request('merchantIban');
		if($merchantIban && mb_strlen($merchantIban) > 34)
		{
			\dash\notif::error('merchantIban is out of range! maximum 34', 'merchantIban');
			return false;
		}

		if($merchantIban && mb_strlen($merchantIban) < 26)
		{
			\dash\notif::error('merchantIban is out of range! minimum 26', 'merchantIban');
			return false;
		}

		if(!$merchantIban)
		{
			\dash\notif::error('merchantIban is required', 'merchantIban');
			return false;
		}




		$Description = \dash\app::request('Description');
		if($Description && mb_strlen($Description) > 255)
		{
			\dash\notif::error("Description is out of range", 'Description');
			return false;
		}



		$check_duplicate_args =
		[
			'customer_id'  => $customer_id,
			'merchantIban' => $merchantIban,
		];

		$check_duplicate = \lib\pardakhtyar\db\merchantIbans::check_duplicate($check_duplicate_args, $_id);
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


		$args                 = [];
		$args['customer_id']  = $customer_id;
		$args['user_id']      = $user_id;
		$args['merchantIban'] = $merchantIban;
		$args['Description']  = $Description;

		return $args;
	}


	public static function remove($_id)
	{
		$load = self::get($_id);
		if(!$load)
		{
			\dash\notif::error('Invalid id');
			return false;
		}

		\lib\pardakhtyar\db\merchantIbans::delete($_id);
		\dash\notif::ok('Iban removed');
		return true;
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

				case 'merchantIban':
					$result[$key] = $value;
					break;


				case 'Address':
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
				case 'merchantType':
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


		$result            = \lib\pardakhtyar\db\merchantIbans::search($_string, $_args);
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