<?php
namespace dash;

class user
{
	/**
	 * The user working by system
	 *
	 * @var        <type>
	 */
	private static $detail = [];


	/**
	 * Initial user in store
	 *
	 * @param      <type>  $_user_id  The user identifier
	 */
	public static function store_init($_user_id = null, $_in_store = false)
	{
		if(!$_user_id && isset($_SESSION['auth']['id']))
		{
			$_user_id = $_SESSION['auth']['id'];
		}

		if(!is_numeric($_user_id))
		{
			return;
		}

		if(!$_in_store)
		{
			$detail  = \dash\db\users::get_by_jibres_user_id($_user_id);
		}
		else
		{
			$detail  = \dash\db\users::get_by_id($_user_id);
		}

		if(!isset($detail['id']))
		{
			return;
		}

		if(is_array($detail))
		{
			$detail = \dash\app::fix_avatar($detail);
			$detail['fullname'] = self::fullName($detail);
			foreach ($detail as $key => $value)
			{

				if($value === null)
				{
					// nothing
				}
				else
				{
					self::$detail[$key] = $value;
					$_SESSION[self::store_auth_key()][$key] = $value;
				}
			}
		}

		$_SESSION[self::store_auth_key()]['logintime'] = time();
		$_SESSION[self::store_auth_key()]['id'] = $detail['id'];

	}


	/**
	 * save key of session store by slug of store
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function store_auth_key()
	{
		return 'store_auth_'. \lib\store::store_slug();
	}



	/**
	 * Determines if initialize store user.
	 * call from engine store to not duplicate init
	 * @return     boolean  True if initialize store user, False otherwise.
	 */
	public static function is_init_store_user($_need = null)
	{
		if($_need)
		{
			return self::get_session_by_key(self::store_auth_key(), $_need);
		}

		if(isset($_SESSION[self::store_auth_key()]['id']))
		{
			return $_SESSION[self::store_auth_key()]['id'];
		}

		return false;
	}


	/**
	 * Determines if initialize jibres user.
	 * call from enter
	 * @return     boolean  True if initialize jibres user, False otherwise.
	 */
	public static function jibres_user($_need = null)
	{
		if($_need)
		{
			return self::get_session_by_key('auth', $_need);
		}

		if(isset($_SESSION['auth']['id']))
		{
			return $_SESSION['auth']['id'];
		}

		return false;
	}


	private static function get_session_by_key($_key, $_need)
	{
		if(isset($_SESSION[$_key][$_need]))
		{
			return $_SESSION[$_key][$_need];
		}
		return null;
	}


	/**
	 * Initial user id
	 *
	 * @param      <type>  $_user_id  The user identifier
	 */
	public static function init($_user_id)
	{
		// login on subdomain
		if(self::inStore())
		{
			return self::store_init($_user_id, true);
		}

		if(!is_numeric($_user_id))
		{
			return;
		}

		$detail  = \dash\db\users::get_by_id($_user_id);


		if(!isset($detail['id']))
		{
			return;
		}


		if(is_array($detail))
		{
			$detail = \dash\app::fix_avatar($detail);
			$detail['fullname'] = self::fullName($detail);
			foreach ($detail as $key => $value)
			{

				if($value === null)
				{
					// nothing
				}
				else
				{
					self::$detail[$key] = $value;
					$_SESSION['auth'][$key] = $value;
				}
			}
		}

		$_SESSION['auth']['logintime'] = time();
		$_SESSION['auth']['id'] = $_user_id;
	}


	private static function inStore()
	{
		return \dash\engine\store::inStore();
	}


	private static function detect()
	{
		$user_data  = isset($_SESSION['auth']) ? $_SESSION['auth'] : [];
		$store_data = isset($_SESSION[self::store_auth_key()]) ? $_SESSION[self::store_auth_key()] : [];

		if(self::inStore())
		{
			// supervisor can view all store data
			if(!$store_data && $user_data && isset($user_data['permission']) && $user_data['permission'] === 'supervisor')
			{
				$store_data = $user_data;
			}

			self::$detail = $store_data;
		}
		else
		{
			self::$detail = $user_data;
		}
	}


	public static function refresh()
	{
		$user_id = self::id();
		self::destroy();

		if(self::inStore())
		{
			self::store_init();
		}
		else
		{
			self::init($user_id);
		}
	}


	public static function login($_key = null)
	{
		if($_key === null)
		{
			if(self::id())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return self::detail($_key);
		}
	}


	/**
	 * destroy user id
	 */
	public static function destroy()
	{
		self::$detail = [];

		if(self::inStore())
		{
			unset($_SESSION[self::store_auth_key()]);
		}
		else
		{
			unset($_SESSION['auth']);
		}

	}

	/**
	 * Full destroy user id
	 */
	public static function full_destroy()
	{
		self::$detail = [];
		unset($_SESSION[self::store_auth_key()]);
		unset($_SESSION['auth']);
	}


	/**
	 * return current version
	 *
	 * @return     string  The current version of dash
	 */
	public static function id()
	{
		self::detect();

		$id = null;

		if(isset(self::$detail['id']))
		{
			$id = self::$detail['id'];
		}


		if(is_numeric($id))
		{
			return intval($id);
		}

		return $id;
	}


	public static function code()
	{
		if(self::id())
		{
			return \dash\coding::encode(self::id());
		}
		return null;
	}


	public static function mobile()
	{
		$mobile = \dash\user::detail('mobile');
		if($mobile)
		{
			return $mobile;
		}

		return null;
	}


	public static function chatid()
	{
		$chatid = \dash\user::detail('chatid');
		if($chatid)
		{
			return $chatid;
		}

		return null;
	}



	public static function budget()
	{
		if(!self::id())
		{
			return 0;
		}

		$temp = \dash\temp::get('USER_BUDGET');
		if($temp)
		{
			return $temp;
		}
		else
		{
			$budget = floatval(\dash\db\transactions::budget(self::id()));
			\dash\temp::set('USER_BUDGET', $budget);
			return $budget;
		}
	}


	public static function fullName($_detail = null)
	{
		if(!$_detail || !is_array($_detail))
		{
			$myDetail = \dash\user::detail();
		}
		else
		{
			$myDetail = $_detail;
		}

		if($myDetail)
		{
			$myName = '';
			if(isset($myDetail['firstname']) && isset($myDetail['lastname']))
			{
				$myName = $myDetail['firstname']. ' '. $myDetail['lastname'];
			}
			elseif(isset($myDetail['displayname']))
			{
				$myName = $myDetail['displayname'];
			}
			else
			{
				$myName = T_("Without name");
			}

			if(isset($myDetail['gender']))
			{
				if($myDetail['gender'] === 'male')
				{
					$myName = T_("Mr"). ' '. $myName;
				}
				else if($myDetail['gender'] === 'female')
				{
					$myName = T_("Mrs"). ' '. $myName;
				}
			}

			return $myName;
		}

		return null;
	}


	/**
	 * get detail of user
	 *
	 * @param      <type>  $_key   The key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function detail($_key = null)
	{
		self::detect();

		if(empty(self::$detail))
		{
			return null;
		}

		if($_key)
		{
			if(isset(self::$detail[$_key]))
			{
				return self::$detail[$_key];
			}
			return null;
		}
		else
		{
			if(isset(self::$detail))
			{
				return self::$detail;
			}
			return null;
		}
	}


	public static function sidebar()
	{
		$sidebar = \dash\user::detail('sidebar');

		if(is_null($sidebar) || $sidebar === '')
		{
			return null;
		}

		if(intval($sidebar) === 1)
		{
			return true;
		}
		elseif($sidebar === '0')
		{
			return false;
		}

		return null;
	}

	/**
	* check is set remember of this user and login by this
	*
	*/
	public static function check_remeber_login()
	{
		if(\dash\url::content() === 'hook')
		{
			// no check in tg and bank
			return;
		}

		// check if have cookie set login by remember
		if(!\dash\user::login())
		{
			$cookie = \dash\db\sessions::get_cookie();
			if(!$cookie)
			{
				return;
			}

			$user_id = \dash\db\sessions::get_user_id_from_cookie();

			if($user_id && is_numeric($user_id))
			{
				$load_user = \dash\db\users::get_by_id($user_id);

				if(!isset($load_user['id']))
				{
					\dash\db\sessions::terminate_cookie();
					return;
				}

				$logi_by_remember = false;

				if(array_key_exists('forceremember', $load_user))
				{
					if(is_null($load_user['forceremember']))
					{
						// default of this variable is true
						$logi_by_remember = true;
					}
					elseif(is_numeric($load_user['forceremember']))
					{
						if(intval($load_user['forceremember']) === 0)
						{
							$logi_by_remember = false;
							// no login by remember
						}
						elseif(intval($load_user['forceremember']) === 1)
						{
							$logi_by_remember = true;

						}
					}
				}

				if($logi_by_remember)
				{
					// login accessed and user must be login
					self::init($user_id);

					if(isset($_SESSION['main_account']))
					{
						// if the admin user login by this user
						// not save the session
					}
					else
					{
						\dash\db\sessions::set($user_id);
						\dash\log::set('userLoginByRemember');
					}
				}
				else
				{
					// code find and not use to login
					// then we terminate this code
					\dash\db\sessions::terminate_cookie();
				}
			}
			else
			{
				// no user id found from this cookie
				// delete it
				\dash\db\sessions::terminate_cookie();
			}

		}
		else
		{
			// check session is not deactive
			$cookie = \dash\db\sessions::get_cookie();

			if(!$cookie)
			{
				return;
			}

			if(isset($_SESSION['main_account']))
			{
				// if the admin user login by this user
				// not save the session
			}
			else
			{
				// check active session every 1 min
				// to not run query in every request
				if(isset($_SESSION['last_check_session_active']) && $_SESSION['last_check_session_active'])
				{
					if(time() - intval($_SESSION['last_check_session_active']) < 60)
					{
						return;
					}
				}

				$_SESSION['last_check_session_active'] = time();

				$status = \dash\db\sessions::is_active($cookie, \dash\user::id());

				if($status === false)
				{
					if(\dash\engine\store::inStore())
					{
						// check from master
						$status = \dash\db\sessions::is_active_master($cookie, \dash\user::jibres_user());

						if($status === true)
						{
							// this cookie ok in master database
							return;
						}
					}

					\dash\db\sessions::disable_cookie($cookie, \dash\user::id());

					\dash\db\sessions::terminate_cookie();

					\dash\log::set('userForceLogoutAuto');
					// muset force logout this user
					\dash\utility\enter::set_logout(\dash\user::id());
				}
			}
		}
	}
}
?>
