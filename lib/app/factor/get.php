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


		$_id = self::fix_id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Factor id not set"));
			return false;
		}

		if(!is_numeric($_id))
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
		$factor = self::one($_id);
		if(!$factor)
		{
			return false;
		}

		$_id = self::fix_id($_id);

		$factor_detail = \lib\db\factordetails\get::by_factor_id_join_product($_id);

		$result                  = [];
		$result['factor']        = $factor;
		$result['factor_detail'] = $factor_detail;

		return $result;
	}
}
?>