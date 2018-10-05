<?php
namespace lib\app\inventory;


trait add
{

	/**
	 * add new user and save the userstore record
	 *
	 * @param      <type>  $_args    The arguments
	 * @param      array   $_option  The option
	 */
	public static function add($_args, $_option = [])
	{
		$default_option =
		[
			'store_id' => null,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\dash\app::variable($_args);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("user not found"), 'user');
			return false;
		}

		if(!\lib\store::id() && !$_option['store_id'])
		{
			\dash\notif::error(T_("store not found"), 'store');
			return false;
		}

		if(!\lib\userstore::in_store())
		{
			\dash\notif::error(T_("You are not in this store"), 'subdomain');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return = [];

		$args['store_id'] = \lib\store::id();

		if(!$args['status'])
		{
			$args['status']  = 'enable';
		}

		$inventory_id = \lib\db\inventory::insert($args);

		if(!$inventory_id)
		{
			\dash\log::set('dbErrorInsertInventory');
			\dash\notif::error(T_("No way to insert inventory"), 'db', 'system');
			return false;
		}

		$return['inventory_id'] = \dash\coding::encode($inventory_id);

		return $return;
	}
}
?>