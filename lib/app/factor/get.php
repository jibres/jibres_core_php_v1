<?php
namespace lib\app\factor;


class get
{

	private static $factor_detail = [];


	public static function product_count_ordered($_product_id)
	{
		$id = \dash\validate::id($_product_id);

		if($id)
		{
			$stat = \lib\db\factordetails\get::product_ordered_stat($id);

			return $stat;
		}

		return null;
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


	public static function inline_get($_id, $_debug = true)
	{
		$_id = \dash\validate::string_50($_id);
		if(!$_id)
		{
			if($_debug)
			{
				\dash\notif::error(T_("Factor id not set"));
			}
			return false;
		}

		$_id = self::fix_id($_id);

		if(!\dash\validate::id($_id))
		{
			if($_debug)
			{
				\dash\notif::error(T_("Invalid factor id"));
			}
			return false;
		}

		$result = \lib\db\factors\get::by_id($_id);

		if(!$result)
		{
			if($_debug)
			{
				\dash\notif::error(T_("Factor not found"));
			}
			return false;
		}

		return $result;
	}

	public static function inline_get_by_detail($_id)
	{
		$factor = self::inline_get($_id, false);
		if(!$factor)
		{
			return false;
		}

		$id = self::fix_id($_id);

		if(!$id)
		{
			return false;
		}

		$factor_detail = \lib\db\factordetails\get::by_factor_id_join_product($id);

		if($factor_detail)
		{
			$factor_detail = array_map(['\\lib\\app\\factor\\ready', 'detail'], $factor_detail);
		}

		$result = [];
		$result['factor'] = $factor;
		$result['factor_detail'] = $factor_detail;

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

		\dash\permission::access('_group_orders');

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

		$guest = \dash\user::get_user_guest();

		if(!\dash\user::id())
		{
			if(!$guest)
			{
				\dash\redirect::to_login();
				return null;
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
			$factor = \lib\db\factors\get::load_my_order_guestid($_id, $guest);
		}

		if(!isset($factor['id']))
		{
			if($guest)
			{
				\dash\redirect::to_login();
			}
			return null;
		}

		$products = \lib\db\factordetails\get::get_product_by_factor_id($factor['id']);
		if(is_array($products))
		{
			foreach ($products as $key => $value)
			{
				$products[$key] = \lib\app\product\ready::row($value);
			}
		}

		// load address saved on this factor
		$factor_address = \lib\db\factorshipping\get::by_factor_id($factor['id']);
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
			$factor_detail = array_map(['\\lib\\app\\factor\\ready', 'detail'], $factor_detail);
		}

		// load customer detail
		if(isset($factor['customer']) && $factor['customer'])
		{
			$customer_id = \dash\coding::decode($factor['customer']);
			$load_customer = \dash\db\users::get_by_id($customer_id);

			$isLegalCustomer = false;

			if(a($load_customer, 'accounttype') === 'legal')
			{
				$isLegalCustomer = true;
			}

			$customer_detail = [];

			$customer_detail['displayname'] = a($load_customer, 'displayname');
			if($isLegalCustomer)
			{
				if(a($load_customer, 'companyname'))
				{
					$customer_detail['displayname'] = a($load_customer, 'companyname');
				}
			}

			if(isset($load_customer['avatar']))
			{
				$customer_detail['avatar'] = \lib\filepath::fix_avatar($load_customer['avatar']);
			}

			$customer_detail['phone']                 = a($load_customer, 'phone');
			$customer_detail['mobile']                = a($load_customer, 'mobile');


			$customer_detail['companyeconomiccode']   = a($load_customer, 'companyeconomiccode');
			$customer_detail['companyname']           = a($load_customer, 'companyname');
			$customer_detail['companynationalid']     = a($load_customer, 'companynationalid');
			$customer_detail['companyregisternumber'] = a($load_customer, 'companyregisternumber');

			$factor['customer_detail'] = $customer_detail;
		}

		// load address saved on this factor
		$factor_address = \lib\db\factorshipping\get::by_factor_id($_id);

		if(!is_array($factor_address))
		{
			$factor_address = [];
		}

		$factor_address['location_string'] = [];

		if(isset($factor_address['country']) && $factor_address['country'])
		{
			$factor_address['country_name'] = \dash\utility\location\countres::get_localname($factor_address['country']);
			$factor_address['location_string'][] = $factor_address['country_name'];
		}

		if(isset($factor_address['province']) && $factor_address['province'])
		{
			$factor_address['province_name'] = \dash\utility\location\provinces::get_localname($factor_address['province']);
			$factor_address['location_string'][] = $factor_address['province_name'];
		}

		if(isset($factor_address['city']) && $factor_address['city'])
		{
			$factor_address['city_name'] = \dash\utility\location\cites::get_localname($factor_address['city']);
			$factor_address['location_string'][] = $factor_address['city_name'];
		}

		if($factor_address['location_string'])
		{
			$factor_address['location_string'] = implode(T_(","). ' ', $factor_address['location_string']);
		}
		else
		{
			// unset to set address as empty array
			unset($factor_address['location_string']);
		}



		if(!a($factor_address, 'name') && a($factor, 'customer_displayname'))
		{
			$factor_address['name'] = $factor['customer_displayname'];
		}

		if(!a($factor_address, 'mobile') && a($factor, 'customer_mobile'))
		{
			$factor_address['mobile'] = $factor['customer_mobile'];
		}

		$factor_action = \lib\app\factor\action::get_by_factor_id($_id);

		$discount_code = [];

		if(a($factor, 'discount_id'))
		{
			$discount_code = \lib\app\discount\get::get($factor['discount_id']);
		}


		$result                  = [];
		$result['factor']        = $factor;
		$result['factor_detail'] = $factor_detail;
		$result['address']       = $factor_address;
		$result['action']        = $factor_action;
		$result['discount_code'] = $discount_code;

		return $result;
	}
}
?>