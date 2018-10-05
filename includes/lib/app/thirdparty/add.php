<?php
namespace lib\app\thirdparty;


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

		if($_option['store_id'] && is_numeric($_option['store_id']))
		{
			$args['store_id'] = $_option['store_id'];
		}
		else
		{
			$args['store_id'] = \lib\store::id();
		}

		if(!$args['status'])
		{
			$args['status']  = 'active';
		}

		if(isset($args['code']) && $args['code'])
		{

			$check_duplicate =
			[
				'code'     => $args['code'],
				'store_id' => \lib\store::id(),
				'limit'    => 1,
			];

			$check_duplicate = \lib\db\userstores::get($check_duplicate);

			if(isset($check_duplicate['id']))
			{
				\dash\notif::error(T_("Duplicate customer code in this store"), 'code');
				return false;
			}
		}

		$supplier_id = null;

		if(isset($args['supplier']) && $args['supplier'])
		{
			$supplier                = [];
			$supplier['supplier']    = 1;
			$supplier['status']      = 'active';
			$supplier['displayname'] = $args['displayname'];
			$supplier['companyname'] = $args['displayname'];
			$supplier['user_id']     = self::signup(['displayname' => $args['displayname']]);
			if($_option['store_id'] && is_numeric($_option['store_id']))
			{
				$supplier['store_id'] = $_option['store_id'];
			}
			else
			{
				$supplier['store_id'] = \lib\store::id();
			}

			$supplier_id             = \lib\db\userstores::insert($supplier);

			if(!$supplier_id)
			{
				\dash\log::set('dbErrorInsertSupplier');
				\dash\notif::error(T_("No way to insert supplier"));
				return false;
			}

			unset($args['supplier']);
			unset($args['companyname']);

			$args['visitor']     = $supplier_id;
			$args['displayname'] = trim($args['firstname']. ' '. $args['lastname']);
			$args['customer']    = 1;
		}

		$user_id = self::find_user_id($args, null);

		if($user_id === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!$user_id)
		{
			\dash\notif::error(T_("We can not signup new user"));
			return false;
		}

		$args['user_id'] = $user_id;


		$userstore_id = \lib\db\userstores::insert($args);

		if(!$userstore_id)
		{
			\dash\log::set('dbErrorInsertUserstores');
			\dash\notif::error(T_("No way to insert thirdparty"), 'db', 'system');
			return false;
		}

		$return['thirdparty_id'] = \dash\coding::encode($supplier_id ? $supplier_id : $userstore_id);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Thirdparty successfuly added"));
			\lib\app\store::user_count('thirdparty', true);
		}

		return $return;
	}
}
?>