<?php
namespace dash\app\user;


trait add
{
	public static function quick_add($_args = [], $_non_jibres_user = false)
	{
		if(!$_non_jibres_user)
		{
			// in stroe whene user signuped we need to set jibres_user_id
			if(\dash\engine\store::inStore() && isset($_args['mobile']))
			{
				$mobile = \dash\validate::mobile($_args['mobile']);
				if($mobile)
				{
					$jibres_user_add           = [];
					$jibres_user_add['mobile'] = $mobile;
					$_args['jibres_user_id']   = \lib\app\sync\user::jibres_user_id($jibres_user_add);
				}
			}
		}

		if(isset($_args['displayname']) && mb_strlen($_args['displayname']) > 99)
		{
			$_args['displayname'] = null;
		}

		$is_statff = false;

		if(isset($_args['permission']) && $_args['permission'])
		{
			$is_statff = true;
		}

		$user_id =  \dash\db\users\insert::signup($_args);

		if(!$_non_jibres_user)
		{
			// in stroe whene user signuped we need to set jibres_user_id
			if(\dash\engine\store::inStore())
			{
				$load_user = \dash\db\users::get_by_id($user_id);
				\dash\app\user::update_jibres_store_user($load_user, $_args, $is_statff);
			}
		}

		return $user_id;
	}



	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{
		$default_option =
		[
			'debug'           => true,
			'non-jibres-user' => false
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!\dash\user::id())
		{
			if($_option['debug']) \dash\notif::error(T_("User not found"), 'user');
			return false;
		}


		// check args
		$args = self::check($_args, null, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return         = [];

		if(!$args['status'])
		{
			$args['status'] = 'awaiting';
		}

		$check_mobile_exist = \dash\db\users::get_by_mobile($args['mobile']);
		if(isset($check_mobile_exist['id']))
		{
			if($_option['debug']) \dash\notif::error(T_("Duplicate mobile"), 'mobile');
			return null;
		}

		if($args['nationalcode'] || $args['pasportcode'])
		{
			if($args['nationalcode'] || $args['pasportcode'])
			{
				$check_duplicate_nationalcode = self::check_duplicate($args['nationalcode'], $args['pasportcode']);

				if($check_duplicate_nationalcode)
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

		if(isset($_option['non-jibres-user']) && $_option['non-jibres-user'])
		{
			$user_id = \dash\app\user::quick_add($args, true);
		}
		else
		{
			$user_id = \dash\app\user::quick_add($args);
		}

		if(!$user_id)
		{
			\dash\log::set('api:user:no:way:to:insert:user');
			if($_option['debug']) \dash\notif::error(T_("No way to insert user"), 'db', 'system');
			return false;
		}

		$return['id']      = \dash\coding::encode($user_id);
		$return['user_id'] = \dash\coding::encode($user_id);

		\dash\log::set('addNewUser', ['code' => $user_id]);
		// $_option['user_id'] = $user_id;

		if(\dash\engine\process::status())
		{
			if($_option['debug']) \dash\notif::ok(T_("User successfuly added"));
		}

		return $return;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function choose_or_add($_args)
	{
		$condition =
		[
			'customer'    => 'code',
			'mobile'      => 'mobile',
			'displayname' => 'displayname',
			'gender'      => ['enum' => ['male', 'female']],
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data['customer'])
		{
			$customer_id = \dash\coding::decode($data['customer']);
			if($customer_id)
			{
				$customer_detail = \dash\db\users::get_by_id($customer_id);
				if(!isset($customer_detail['id']))
				{
					\dash\notif::error(T_("Customer detail is invalid"), 'customer');
					return false;
				}
				else
				{
					$data['customer'] = $customer_detail['id'];
				}
			}
			else
			{
				$data['customer'] = null;
			}
		}

		if(!$data['customer'])
		{

			if($data['mobile'])
			{
				$data['customer'] = \dash\app\user::quick_add(['mobile' => $data['mobile'], 'gender' => $data['gender'], 'displayname' => $data['displayname']]);
			}
			else
			{
				if($data['displayname'])
				{
					$check_exist_displayname = \dash\db\users::get_by_displayname($data['displayname']);
					if(isset($check_exist_displayname['id']))
					{
						\dash\notif::error(T_("This thirdparyt already added to your store. plase set her mobile or change the name"), 'displayname');
						return false;
					}
					else
					{
						$data['customer'] = \dash\app\user::quick_add(['mobile' => null, 'gender' => $data['gender'], 'displayname' => $data['displayname']]);
					}
				}
			}
		}


		return $data['customer'];
	}
}
?>