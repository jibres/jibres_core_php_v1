<?php
namespace lib\app\thirdparty;


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

		$check_not_duplicate_userstore = false;

		/**
		 ****************************************************************************
		 * find user id
		 *
		 * @var        <type>
		 */
		// post to add new thirdparty
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
					$check_not_duplicate_userstore = true;
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
			$userstore_detail = \lib\db\userstores::get(['id' => $_id, 'store_id' => \lib\store::id(), 'limit' => 1]);

			if(isset($userstore_detail['user_id']))
			{
				$request_user_id = $userstore_detail['user_id'];
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
						$check_not_duplicate_userstore = true;
					}
					else
					{
						$check_user_exist = \dash\db\users::get_by_mobile($mobile);
						// the mobile was exist
						if(isset($check_user_exist['id']))
						{
							$master_user_id = $check_user_exist['id'];
							$check_not_duplicate_userstore = true;
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
						$check_not_duplicate_userstore = true;
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

		if($check_not_duplicate_userstore)
		{
			$userstore_record = \lib\db\userstores::get(['user_id' => $master_user_id, 'store_id' => \lib\store::id(), 'limit' => 1]);

			\dash\temp::set('userstore_record', $userstore_record);

			if(isset($userstore_record['id']))
			{
				if(intval($userstore_record['id']) === intval($_id))
				{
					// no problem
				}
				else
				{
					$msg = T_("This user was already added to this store");
					if(isset($userstore_record['mobile']))
					{
						$msg = "<a href='". \dash\url::here(). '/thirdparty?q='. $userstore_record['mobile']. "'>$msg</a>";
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
