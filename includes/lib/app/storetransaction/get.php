<?php
namespace lib\app\storetransaction;

trait get
{


	/**
	 * Gets the storetransaction.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The storetransaction.
	 */
	public static function get($_args, $_option = [])
	{
		\lib\app::variable($_args);

		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!\lib\user::id())
		{
			\lib\app::log('api:storetransaction:user:id:not:found', \lib\user::id(), \lib\app::log_meta());
			if($_option['debug']) \lib\debug::error(T_("User id not found"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:storetransaction:store:id:not:found', \lib\user::id(), \lib\app::log_meta());
			if($_option['debug']) \lib\debug::error(T_("Store id not found"));
			return false;
		}


		$id = \lib\app::request("id");
		$id = \lib\utility\shortURL::decode($id);
		if(!$id)
		{
			\lib\app::log('api:storetransaction:id:shortname:not:set', \lib\user::id(), \lib\app::log_meta());
			if($_option['debug']) \lib\debug::error(T_("Store id or shortname not set"), 'id', 'arguments');
			return false;
		}

		$result = \lib\db\storetransactions::get(['id' => $id, 'store_id' => \lib\store::id()]);

		$result = self::ready($result);
		return $result;

	}
}
?>