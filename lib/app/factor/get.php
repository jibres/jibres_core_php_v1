<?php
namespace lib\app\factor;


class get
{

	private static $factor_detail    = [];
	private static $factor_prev      = [];
	private static $factor_next      = [];


	public static function next($_id, $_raw = false)
	{
		if(isset(self::$factor_next[$_id]))
		{
			return self::$factor_next[$_id];
		}

		$result = self::one($_id);

		if(!$result)
		{
			return false;
		}

		$next = \lib\db\factors\get::next($result['id']);

		if(!$next)
		{
			$next = \lib\db\factors\get::first_factor_id();
		}

		if(!$_raw)
		{
			$next = \dash\url::here(). '/order/detail?id='. $next;
		}

		self::$factor_next[$_id] = $next;

		return $next;
	}


	public static function prev($_id, $_raw = false)
	{
		if(isset(self::$factor_prev[$_id]))
		{
			return self::$factor_prev[$_id];
		}

		$result = self::one($_id);

		if(!$result)
		{
			return false;
		}

		$prev = \lib\db\factors\get::prev($result['id']);

		if(!$prev)
		{
			$prev = \lib\db\factors\get::end_factor_id();
		}

		if(!$_raw)
		{
			$prev = \dash\url::here(). '/order/detail?id='. $prev;
		}

		self::$factor_prev[$_id] = $prev;

		return $prev;
	}



	public static function fix_id($_id)
	{
		if(substr($_id, 0, 2) === 'JF')
		{
			$_id = substr($_id, 2);
		}

		$_id = \dash\validate::id($_id, false);

		return $_id;
	}


	public static function by_id($_id)
	{
		return self::one($_id);
	}


	public static function inline_get($_id)
	{
		$_id = \dash\validate::string_50($_id);
		if(!$_id)
		{
			\dash\notif::error(T_("Factor id not set"));
			return false;
		}

		$_id = self::fix_id($_id);

		if(!\dash\validate::id($_id))
		{
			\dash\notif::error(T_("Invalid factor id"));
			return false;
		}

		$result = \lib\db\factors\get::by_id($_id);

		if(!$result)
		{
			\dash\notif::error(T_("Factor not found"));
			return false;
		}

		return $result;
	}

	/**
	 * Gets the factor.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The factor.
	 */
	public static function one($_id)
	{

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$_id = \dash\validate::string_50($_id);
		if(!$_id)
		{
			\dash\notif::error(T_("Factor id not set"));
			return false;
		}

		$_id = self::fix_id($_id);

		if(!\dash\validate::id($_id))
		{
			\dash\notif::error(T_("Invalid factor id"));
			return false;
		}

		$result = \lib\db\factors\get::by_id($_id);

		if(!$result)
		{
			\dash\notif::error(T_("Factor not found"));
			return false;
		}

		$result = \lib\app\factor\ready::row($result);

		return $result;
	}


	public static function user_factor($_id, $_user_id)
	{
		$_id = self::fix_id($_id);
		if(!$_user_id || !$_id)
		{
			return false;
		}

		$_id      = \dash\validate::id($_id);
		$_user_id = \dash\validate::id($_user_id);

		$result = \lib\db\factors\get::by_id_user_id($_id, $_user_id);

		if(!$result)
		{
			return false;
		}

		$result = \lib\app\factor\ready::row($result);

		return $result;



	}



	public static function load_my_order($_id)
	{
		$_id = self::fix_id($_id);
		if(!$_id)
		{
			return false;
		}

		if(!\dash\user::id())
		{
			if(!\dash\user::get_user_guest())
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		$factor         = [];
		$products       = [];
		$factor_address = [];
		$factor_action  = [];

		if(\dash\user::id())
		{
			$factor = \lib\db\factors\get::load_my_order_user_id($_id, \dash\user::id());
		}
		else
		{
			$factor = \lib\db\factors\get::load_my_order_guestid($_id, \dash\user::get_user_guest());
		}

		if(!isset($factor['id']))
		{
			return false;
		}

		$products = \lib\db\factordetails\get::get_product_by_factor_id($factor['id']);
		if(is_array($products))
		{
			foreach ($products as $key => $value)
			{
				if(isset($value['count']))
				{
					$value['count'] = \lib\number::down($value['count']);
				}
				if(isset($value['sum']))
				{
					$value['sum'] = \lib\number::down($value['sum']);
					$value['sum'] = \lib\price::down($value['sum']);
				}

				$products[$key] = \lib\app\product\ready::row($value);
			}
		}

		// load address saved on this factor
		$factor_address = \lib\db\factoraddress\get::by_factor_id($factor['id']);
		$factor_address = \dash\app\address::ready($factor_address);

		$factor_action = \lib\app\factor\action::get_by_factor_id_public($factor['id']);

		if(is_array($factor))
		{
			$factor = \lib\app\factor\ready::row($factor);
		}


		$result             = [];
		$result['order']    = $factor;
		$result['products'] = $products;
		$result['address']  = $factor_address;
		$result['action']   = $factor_action;

		return $result;

	}

	public static function full($_id)
	{
		// load factor
		$factor = self::one($_id);
		if(!$factor)
		{
			\dash\header::status(404, T_("Factor not found"));
			return false;
		}

		$_id = self::fix_id($_id);

		// load factor detail
		$factor_detail = \lib\db\factordetails\get::by_factor_id_join_product($_id);

		if($factor_detail)
		{
			$factor_detail = array_map(['\\lib\\app\\factor\\ready', 'row'], $factor_detail);
		}

		// load customer detail
		if(isset($factor['customer']) && $factor['customer'])
		{
			$customer_id = \dash\coding::decode($factor['customer']);
			$load_customer = \dash\db\users::get_by_id($customer_id);

			if(isset($load_customer['displayname']))
			{
				$factor['customer_displayname'] = $load_customer['displayname'];
			}

			if(isset($load_customer['phone']))
			{
				$factor['customer_phone'] = $load_customer['phone'];
			}

			if(isset($load_customer['mobile']))
			{
				$factor['customer_mobile'] = $load_customer['mobile'];
			}

			$load_user_legal = \dash\app\user\legal::get($factor['customer']);
			$factor['customer_legal'] = $load_user_legal;

		}

		// load address saved on this factor
		$factor_address = \lib\db\factoraddress\get::by_factor_id($_id);

		if(!is_array($factor_address))
		{
			$factor_address = [];
		}

		if(!\dash\get::index($factor_address, 'name') && \dash\get::index($factor, 'customer_displayname'))
		{
			$factor_address['name'] = $factor['customer_displayname'];
		}

		if(!\dash\get::index($factor_address, 'mobile') && \dash\get::index($factor, 'customer_mobile'))
		{
			$factor_address['mobile'] = $factor['customer_mobile'];
		}

		$factor_action = \lib\app\factor\action::get_by_factor_id($_id);


		$result                  = [];
		$result['factor']        = $factor;
		$result['factor_detail'] = $factor_detail;
		$result['address']       = $factor_address;
		$result['action']        = $factor_action;

		return $result;
	}
}
?>