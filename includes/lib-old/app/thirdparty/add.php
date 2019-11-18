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
			'debug'    => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\dash\app::variable($_args);

		if(!\dash\user::id())
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("user not found"), 'user');
			}
			return false;
		}

		if(!\lib\store::id() && !$_option['store_id'])
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("store not found"), 'store');
			}
			return false;
		}

		if(!\lib\userstore::in_store() && !$_option['store_id'])
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("You are not in this store"), 'subdomain');
			}
			return false;
		}

		// check args
		$args = self::check(null, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		$return = [];
		$check_plan_limit = true;
		if($_option['store_id'] && is_numeric($_option['store_id']))
		{
			$args['store_id'] = $_option['store_id'];
			$check_plan_limit = false;
		}
		else
		{
			$args['store_id'] = \lib\store::id();
		}

		if($check_plan_limit)
		{
			if(!\lib\app\plan_limit::check('thirdparty'))
			{
				return false;
			}
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
				'store_id' => $args['store_id'],
				'limit'    => 1,
			];

			$check_duplicate = \lib\db\userstores::get($check_duplicate);

			if(isset($check_duplicate['id']))
			{
				if($_option['debug'])
				{
					\dash\notif::error(T_("Duplicate customer code in this store"), 'code');
				}
				return false;
			}
		}

		$supplier_id = null;

		if(isset($args['supplier']) && $args['supplier'])
		{
			if(!$args['companyname'])
			{
				if($_option['debug'])
				{
					\dash\notif::error(T_("Plese fill the company name"), 'companyname');
				}
				return false;
			}

			$supplier                = [];

			if($_option['store_id'] && is_numeric($_option['store_id']))
			{
				$supplier['store_id'] = $_option['store_id'];
			}
			else
			{
				$supplier['store_id'] = \lib\store::id();
			}

			$check                = [];
			$check['store_id']    = $supplier['store_id'];
			$check['supplier']    = 1;
			$check['companyname'] = $args['companyname'];
			$check['limit']       = 1;

			$check_query = \lib\db\userstores::get($check);

			if(isset($check_query['id']))
			{
				$msg = T_("Company :companyname was already added to this store", ['companyname' => $args['companyname']]);
				$msg = "<a href='". \dash\url::here(). '/thirdparty/general?id='. \dash\coding::encode($check_query['id']). "'>$msg</a>";
				if($_option['debug'])
				{
					\dash\notif::error($msg, 'companyname');
				}
				return false;
			}


			$supplier['supplier']    = 1;
			$supplier['status']      = 'active';
			$supplier['displayname'] = $args['companyname'];
			$supplier['companyname'] = $args['companyname'];
			$supplier['user_id']     = self::signup(['displayname' => $args['companyname']]);

			$supplier_id             = \lib\db\userstores::insert($supplier);

			if(!$supplier_id)
			{
				\dash\log::set('dbErrorInsertSupplier');
				if($_option['debug'])
				{
					\dash\notif::error(T_("No way to insert supplier"));
				}
				return false;
			}

			unset($args['supplier']);
			unset($args['companyname']);

			$args['visitor']     = $supplier_id;
			$args['customer']    = 1;
		}



		$user_id = self::find_user_id($args, null);

		if($user_id === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!$user_id)
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("We can not signup new user"));
			}
			return false;
		}

		$args['user_id'] = $user_id;


		$user_id = \lib\db\userstores::insert($args);

		if(!$user_id)
		{
			\dash\log::set('dbErrorInsertUserstores');
			if($_option['debug'])
			{
				\dash\notif::error(T_("No way to insert thirdparty"), 'db', 'system');
			}
			return false;
		}

		$return['thirdparty_id'] = \dash\coding::encode($supplier_id ? $supplier_id : $user_id);

		if(\dash\engine\process::status())
		{
			if($_option['debug'])
			{
				\dash\notif::ok(T_("Thirdparty successfuly added"));
			}
			\lib\app\store::user_count('thirdparty', true);
		}

		return $return;
	}
}
?>