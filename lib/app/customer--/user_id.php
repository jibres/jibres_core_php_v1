<?php
namespace lib\app\customer;


trait user_id
{
	/**
	 * find user id
	 *
	 * @param      <type>   $_args      The arguments
	 * @param      <type>   $  The log meta
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function find_user_id($_args, $_id)
	{

		$mobile           = null;
		$mobile_syntax    = null;
		$check_user_exist = null;

		$mobile           = \dash\app::request("mobile");
		$mobile_syntax    = \dash\utility\filter::mobile($mobile);

		if($mobile && !$mobile_syntax)
		{
			\dash\notif::error(T_("Invalid mobile number"), 'mobile', 'arguments');
			return false;
		}
		elseif($mobile && $mobile_syntax && ctype_digit($mobile))
		{
			$mobile = $mobile_syntax;
		}
		else
		{
			$mobile_syntax = $mobile = null;
		}

		$check_not_duplicate_user = false;

		/**
		 ****************************************************************************
		 * find user id
		 *
		 * @var        <type>
		 */
		// post to add new customer
		if(!$_id)
		{
			// mobile is set
			if($mobile)
			{
				$check_user_exist = \dash\db\users::get_by_mobile($mobile);
				// the mobile was exist
				if(isset($check_user_exist['id']))
				{
					$master_user_id = $check_user_exist['id'];
					$check_not_duplicate_user = true;
				}
				else
				{
					$master_user_id = self::signup($_args);
				}
			}
			else
			{
				$master_user_id = self::signup($_args);
			}
		}
		elseif($_id)
		{
			$user_detail = \lib\db\users::get(['id' => $_id, 'store_id' => \lib\store::id(), 'limit' => 1]);

			if(isset($user_detail['user_id']))
			{
				$request_user_id = $user_detail['user_id'];
			}
			else
			{
				\dash\notif::error(T_("Invalid user id"), 'user');
				return false;
			}

			if($request_user_id)
			{
				$old_user_id = \dash\db\users::get(['id' => $request_user_id, 'limit' => 1]);

				if(!isset($old_user_id['id']) || !array_key_exists('mobile', $old_user_id))
				{
					\dash\notif::error(T_("Invalid user id"), 'user');
					return false;
				}
			}
			else
			{
				\dash\notif::error(T_("User id not set"), 'user');
				return false;
			}

			if($old_user_id['mobile'])
			{
				if($mobile)
				{
					if($mobile == $old_user_id['mobile'])
					{
						$master_user_id = $old_user_id['id'];
						$check_not_duplicate_user = true;
					}
					else
					{
						$check_user_exist = \dash\db\users::get_by_mobile($mobile);
						// the mobile was exist
						if(isset($check_user_exist['id']))
						{
							$master_user_id = $check_user_exist['id'];
							$check_not_duplicate_user = true;
						}
						else
						{
							$master_user_id = self::signup($_args);
						}
					}
				}
				else
				{
					$master_user_id = self::signup($_args);
				}
			}
			else
			{
				if($mobile)
				{
					// unreachable old user id
					\dash\db\users::update(['status' => 'unreachable'], $old_user_id['id']);

					$check_user_exist = \dash\db\users::get_by_mobile($mobile);
					// the mobile was exist
					if(isset($check_user_exist['id']))
					{
						$master_user_id = $check_user_exist['id'];
						$check_not_duplicate_user = true;
					}
					else
					{
						$master_user_id = self::signup($_args);
					}
				}
				else
				{
					$master_user_id = $old_user_id['id'];
				}
			}
		}

		/**
		 * end find userid
		 ****************************************************************************
		 */

		if(!$master_user_id)
		{
			\dash\notif::error(T_("User id not found"), 'user', 'system');
			return false;
		}

		if($check_not_duplicate_user)
		{
			$user_record = \lib\db\users::get(['user_id' => $master_user_id, 'store_id' => \lib\store::id(), 'limit' => 1]);

			\dash\temp::set('user_record', $user_record);

			if(isset($user_record['id']))
			{
				if(intval($user_record['id']) === intval($_id))
				{
					// no problem
				}
				else
				{
					$msg = T_("This user was already added to this store");
					if(isset($user_record['mobile']))
					{
						$msg = "<a href='". \dash\url::here(). '/customer?q='. $user_record['mobile']. "'>$msg</a>";
					}

					\dash\notif::error($msg, 'mobile');
					return false;

				}

			}
		}

		return $master_user_id;
	}


	public static function signup($_args)
	{
		$master_reuest = \dash\app::request();
		$_args['force_add'] = true;
		$user_id = \dash\app\user::add($_args, ['debug' => false, 'check_mobile' => false]);

		\dash\app::variable($master_reuest);

		if(isset($user_id['user_id']))
		{
			return \dash\coding::decode($user_id['user_id']);
		}

		return 0;
	}
}
?>
