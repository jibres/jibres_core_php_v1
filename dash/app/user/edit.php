<?php
namespace dash\app\user;


trait edit
{

	public static function update_password($_password_hash, $_user_id)
	{
		\dash\db\users::update(['password' => $_password_hash], $_user_id);

		\dash\db\sessions::change_password($_user_id);

		if(\dash\engine\store::inStore())
		{
			$load_user_detail = \dash\db\users::get_by_id($_user_id);
			if(isset($load_user_detail['jibres_user_id']))
			{
				// update password to jibres
				\dash\db\users\update::jibres_password($_password_hash, $load_user_detail['jibres_user_id']);

				// update password to other session
				\dash\db\users\update::jibres_password_in_other_store($_password_hash, $load_user_detail['jibres_user_id'], \lib\store::id());
			}
		}
		else
		{
			// in jibres
			// update password in all store
			\dash\db\users\update::jibres_password_in_all_store($_password_hash, $_user_id);
		}



	}



	public static function quick_update($_args, $_id)
	{
		// in stroe whene user signuped we need to set jibres_user_id
		if(\dash\engine\store::inStore() && isset($_args['mobile']))
		{
			$mobile = \dash\utility\filter::mobile($_args['mobile']);
			if($mobile)
			{
				$_args['jibres_user_id'] = \lib\app\sync\user::jibres_user_id($_args);
			}
		}

		\dash\log::set('editUser', ['code' => $_id]);

		return \dash\db\users::update($_args, $_id);

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
			if(isset($check_mobile_exist['id']) && intval($check_mobile_exist['id']) !== intval($id))
			{
				\dash\notif::error(T_("Duplicate mobile"), 'mobile');
				return false;
			}
		}

		if($args['email'])
		{
			$check_email_exist = \dash\db\users::get(['email' => $args['email'], 'limit' => 1]);
			if(isset($check_email_exist['id']) && intval($check_email_exist['id']) !== intval($id))
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

				if(isset($check_duplicate_nationalcode['id']) && intval($check_duplicate_nationalcode['id']) === intval($id))
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

		if(!empty($args))
		{
			self::quick_update($args, $id);
		}

		if(\dash\engine\process::status())
		{
			if(intval($id) === intval(\dash\user::id()))
			{
				\dash\user::refresh();
			}

			\dash\notif::ok(T_("User successfully updated"));
		}
	}
}
?>