<?php
namespace lib\app\irvat;


class get
{


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		$load = \lib\db\irvat\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		$load = \lib\db\irvat\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		$load_seller = [];
		if(isset($load['seller']) && $load['seller'])
		{
			$load_seller = self::load_user_detail($load['seller']);
		}

		$load_customer = [];
		if(isset($load['customer']) && $load['customer'])
		{
			$load_customer = self::load_user_detail($load['customer']);
		}

		$load = \lib\app\irvat\ready::row($load);

		$load['seller_detail'] = $load_seller;
		$load['customer_detail'] = $load_customer;

		return $load;
	}


	private static function load_user_detail($_user_id)
	{
		$load_user_detail = \dash\db\users::get_by_id($_user_id);
		$load_user_detail_legal = \dash\app\user\legal::get_inline($_user_id);

		$result = [];
		$result['user'] = \dash\app\user::ready($load_user_detail);
		$result['legal_detail'] = $load_user_detail_legal;

		return $result;
	}

}
?>