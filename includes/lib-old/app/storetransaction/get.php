<?php
namespace lib\app\storetransaction;

trait get
{

	public static function factor_pay_list($_factor_id)
	{
		$_factor_id = \dash\coding::decode($_factor_id);
		if(!$_factor_id)
		{
			return false;
		}
		$result = \lib\db\storetransactions::get(['factor_id' => $_factor_id, 'store_id' => \lib\store::id()]);
		return $result;
	}


	/**
	 * Gets the storetransaction.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The storetransaction.
	 */
	public static function get($_args, $_option = [])
	{
		\dash\app::variable($_args);

		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!\dash\user::id())
		{
			\dash\app::log('api:storetransaction:user:id:not:found', \dash\user::id(), \dash\app::log_meta());
			if($_option['debug']) \dash\notif::error(T_("User id not found"));
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\app::log('api:storetransaction:store:id:not:found', \dash\user::id(), \dash\app::log_meta());
			if($_option['debug']) \dash\notif::error(T_("Store id not found"));
			return false;
		}


		$id = \dash\app::request("id");
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\app::log('api:storetransaction:id:shortname:not:set', \dash\user::id(), \dash\app::log_meta());
			if($_option['debug']) \dash\notif::error(T_("Store id or shortname not set"), 'id', 'arguments');
			return false;
		}

		$result = \lib\db\storetransactions::get(['id' => $id, 'store_id' => \lib\store::id()]);

		$result = self::ready($result);
		return $result;

	}
}
?>