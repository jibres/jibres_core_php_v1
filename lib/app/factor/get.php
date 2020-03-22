<?php
namespace lib\app\factor;


class get
{
	private static function fix_id($_id)
	{
		if(substr($_id, 0, 2) === 'JF')
		{
			$_id = substr($_id, 2);
		}
		return $_id;
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
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

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
			$load_customer = \dash\db\users::get_by_id($factor['customer']);

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

			$factor['customer_address'] = [];
			if(isset($load_customer['id']))
			{
				$user_address = \dash\app\address::get_last_user_address($load_customer['id']);

				$factor['customer_address'] = $user_address;

				if(isset($user_address['name']) && $user_address['name'])
				{
					$factor['customer_displayname'] = $user_address['name'];
				}

				if(isset($user_address['phone']) && $user_address['phone'])
				{
					$factor['customer_phone'] = $user_address['phone'];
				}

				if(isset($user_address['mobile']) && $user_address['mobile'])
				{
					$factor['customer_mobile'] = $user_address['mobile'];
				}
			}
		}

		// load address saved on this factor
		// @reza

		$result                  = [];
		$result['factor']        = $factor;
		$result['factor_detail'] = $factor_detail;
		return $result;
	}
}
?>