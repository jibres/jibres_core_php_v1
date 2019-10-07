<?php
namespace lib\app\store;


class trial
{

	public static function add($_args)
	{
		$plan    = 'trial';
		$user_id = \dash\user::id();

		if(!$user_id)
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		// create new store by free plan
		// just check count of free plan store
		// check store count
		$count_store_free = intval(\lib\db\store\get::count_free_trial($user_id));

		if($count_store_free >= 1)
		{
			$user_budget = \dash\db\transactions::budget($user_id, ['unit' => 'toman']);

			$user_budget = floatval($user_budget);

			if($user_budget < 10000)
			{
				if(\dash\permission::supervisor())
				{
					\dash\notif::warn(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
				}
				else
				{
					\dash\notif::error(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
					return false;
				}
			}
		}

		if($count_store_free >= 2)
		{
			$msg = T_("You can not have more than two free or trial stores.");

			if(\dash\url::isLocal())
			{
				\dash\notif::warn($msg. "\n". T_("This msg in local is warn and in site is error :)"));
			}
			else
			{
				\dash\notif::error($msg);
				return false;
			}
		}

		if($plan === 'trial')
		{
			$_args['startplan']  = date("Y-m-d H:i:s");
			$_args['expireplan'] = date("Y-m-d H:i:s", strtotime("+14 days"));
			$_args['plan']       = 'trial';
		}

		return self::add($_args);

	}
}
?>