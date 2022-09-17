<?php
namespace dash\app\user;


trait edit
{

	public static function update_password($_password_hash, $_user_id)
	{
		\dash\db\users::update(['password' => $_password_hash], $_user_id);

		// \dash\db\login\update::change_password($_user_id);

		//--------------- Every store is free

		// if(\dash\engine\store::inStore())
		// {
		// 	$load_user_detail = \dash\db\users::get_by_id($_user_id);
		// 	if(isset($load_user_detail['jibres_user_id']))
		// 	{
		// 		// update password to jibres
		// 		\dash\db\users\update::jibres_password($_password_hash, $load_user_detail['jibres_user_id']);

		// 		// update password to other session
		// 		\dash\db\users\update::jibres_password_in_other_store($_password_hash, $load_user_detail['jibres_user_id'], \lib\store::id());
		// 	}
		// }
		// else
		// {
		// 	// in jibres
		// 	// update password in all store
		// 	\dash\db\users\update::jibres_password_in_all_store($_password_hash, $_user_id);
		// }



	}



	public static function quick_update($_args, $_id)
	{
		$is_staff  = null;
		$load_user = null;
		$jibres_user_id = null;

		// in stroe whene user signuped we need to set jibres_user_id
		if(\dash\engine\store::inStore())
		{
			$load_user = \dash\db\users::get_by_id($_id);

			$nowIsStaff = a($load_user, 'permission') ? true : false;

			$jibres_user_id = a($load_user, 'jibres_user_id');

			if(isset($load_user['jibres_user_id']) && $load_user['jibres_user_id'] && \lib\store::detail('owner'))
			{
				if(floatval($load_user['jibres_user_id']) === floatval(\lib\store::detail('owner')))
				{
					unset($_args['mobile']);
					unset($_args['permission']);

					if(empty($_args))
					{
						\dash\notif::error(T_("Can not change business owner mobile or permission"));
						return false;
					}
					elseif(array_key_exists('mobile', $_args) || array_key_exists('permission', $_args))
					{
						\dash\notif::warn(T_("Can not change business owner mobile or permission"));
					}
				}
			}


			if(array_key_exists('mobile', $_args))
			{
				if($_args['mobile'])
				{
					$mobile = \dash\validate::mobile($_args['mobile'], false);
					if($mobile)
					{
						$_args['jibres_user_id'] = \lib\app\sync\user::jibres_user_id(['mobile' => $mobile]);
						$jibres_user_id = $_args['jibres_user_id'];
					}
				}
				else
				{
					$_args['jibres_user_id'] = null;
					// remove staff from old jibres user id
					$jibres_user_id          = $load_user['jibres_user_id'];
					$is_staff                = false;
				}
			}

			if(array_key_exists('permission', $_args) || (isset($load_user['permission']) && $load_user['permission']))
			{
				if(isset($_args['status']) && $_args['status'])
				{
					if($_args['status'] === 'removed')
					{
						\dash\notif::error(T_("Please remove user permission first!"));
						return false;
					}
				}

				if(isset($load_user['status']) && $load_user['status'] === 'removed')
				{
					\dash\notif::error(T_("Can not set permission on removed user!"));
					return false;
				}

				if(isset($load_user['jibres_user_id']) && $load_user['jibres_user_id'])
				{
					// ok
				}
				else
				{
					if(isset($load_user['mobile']) && $load_user['mobile'])
					{
						$_args['jibres_user_id'] = \lib\app\sync\user::jibres_user_id(['mobile' => $load_user['mobile']]);
					}
					else
					{
						\dash\notif::error(T_("Please set mobile to this user and then change the permission"));
						return false;
					}
				}

				if(array_key_exists('permission', $_args) && !$_args['permission'])
				{
					$is_staff = false;
				}
				elseif(a($_args, 'permission'))
				{
					$is_staff = true;
				}
				elseif(!a($load_user, 'permission'))
				{
					$is_staff = false;
				}
				elseif(a($load_user, 'permission'))
				{
					$is_staff = true;
				}
				else
				{
					$is_staff = null;
				}
			}

			if(!$nowIsStaff && $is_staff)
			{
				// check plan staff count
				if(!\lib\app\plan\planCheck::access('staff'))
				{
					\dash\notif::error(\lib\app\plan\planCheck::get('staff', 'access_message'), ['alerty' => true]);
					return false;
				}
			}

		}
		else
		{
			// in jibres
			// we never change user mobile
			if(array_key_exists('mobile', $_args))
			{
				\dash\notif::error(T_("Can not change customer mobile in jibres!"));

				unset($_args['mobile']);

				if(empty($_args))
				{
					return false;
				}
			}
		}


		\dash\log::set('editUser', ['code' => $_id]);

		if(a($_args, 'jibres_user_id') != a($load_user, 'jibres_user_id') && a($load_user, 'jibres_user_id'))
		{
			if(\dash\engine\store::inStore())
			{
				// remove old jibres user staff
				\lib\db\store_user\update::jibres_store_user_update(\lib\store::id(), $load_user['jibres_user_id'], ['staff' => 'no']);
			}
		}

		$result = \dash\db\users::update($_args, $_id);


		self::update_jibres_store_user($is_staff, $jibres_user_id);


		return $result;

	}


	public static function update_jibres_store_user($_is_staff, $_jibres_user_id)
	{
		if(!$_jibres_user_id)
		{
			return;
		}

		if($_is_staff === true || $_is_staff === false)
		{
			if($_is_staff === true)
			{
				$set = ['staff' => 'yes'];
			}
			else
			{
				$set = ['staff' => 'no'];
			}

			\lib\db\store_user\update::jibres_store_user_update(\lib\store::id(), $_jibres_user_id, $set);

		}
	}



	/**
	 * edit a user
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args, $_id, $_option = [])
	{

		$default_option =
		[

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		$id = $_id;
		$id = \dash\validate::code($id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit user"), 'user');
			return false;
		}

		$load_user  = \dash\db\users::get_by_id($id);

		if(!isset($load_user['id']))
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}

		// check args
		$args = self::check($_args, $id, $_option, $load_user);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		if($args['mobile'])
		{
			$check_mobile_exist = \dash\db\users::get_by_mobile($args['mobile']);
			if(isset($check_mobile_exist['id']) && floatval($check_mobile_exist['id']) !== floatval($id))
			{
				\dash\notif::error(T_("Duplicate mobile"), 'mobile');
				return false;
			}
		}



		if($args['email'])
		{
			$check_email_exist = \dash\db\users::get(['email' => $args['email'], 'limit' => 1]);
			if(isset($check_email_exist['id']) && floatval($check_email_exist['id']) !== floatval($id))
			{
				\dash\notif::error(T_("Duplicate email"), 'email');
				return false;
			}
		}


		if($args['nationalcode'] || $args['pasportcode'])
		{
			if($args['nationalcode'] || $args['pasportcode'])
			{
				$check_duplicate_nationalcode = self::check_duplicate($args['nationalcode'], $args['pasportcode']);

				if(isset($check_duplicate_nationalcode['id']) && floatval($check_duplicate_nationalcode['id']) === floatval($id))
				{
					// no problem to edit yourself
				}
				elseif($check_duplicate_nationalcode)
				{
					if($args['nationalcode'])
					{
						$nationalcode_q = $args['nationalcode'];
					}
					else
					{
						$nationalcode_q = $args['pasportcode'];
					}

					$msg = T_("Duplicate nationalcode or pasportcode in your user list");
					$msg = "<a href='". \dash\url::kingdom(). '/crm/member?q='. $nationalcode_q. "'>$msg</a>";
					\dash\notif::error($msg, ['nationalcode', 'pasportcode']);
					return false;

				}
			}
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(array_key_exists('mobile', $args) && !a($args, 'mobile') && a($load_user, 'permission'))
		{
			\dash\notif::error(T_("Can not remove mobile of users who have permission!"));
			return false;
		}

		if(!empty($args))
		{
			self::quick_update($args, $id);
		}

		if(\dash\engine\process::status())
		{
			if(floatval($id) === floatval(\dash\user::id()))
			{

			}

			\dash\notif::ok(T_("User successfully updated"));
		}
	}
}
?>