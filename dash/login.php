<?php
namespace dash;


/**
 * This class describes a login.
 *
 */
class login
{
	private static $error = [];
	/**
	 * Check user is login or no
	 *
	 */
	public static function check()
	{
		$cookie = self::read_cookie();

		if(!$cookie)
		{
			return false;
		}

		$place = self::where_am_i();

		if($place === 'jibres' || $place === 'admin')
		{
			$load = \dash\db\login\get::load_code_force_jibres($cookie);
		}
		else
		{
			$load = \dash\db\login\get::load_code($cookie);
		}


		$is_ok = self::validate($load);

		if(!$is_ok)
		{
			if(isset($load['id']))
			{
				if($place === 'jibres' || $place === 'admin')
				{
					$blockMeta = null;
					if(self::$error)
					{
						$blockMeta = json_encode(self::$error, JSON_UNESCAPED_UNICODE);
						$blockMeta = addslashes($blockMeta);
					}

					self::$error = [];

					\dash\db\login\update::set_block($load['id'], 'master', $blockMeta);
				}
				else
				{
					// i dont know where is database of this cookie
					// So, Not blocked it
					// \dash\db\login\update::set_block($load['id']);
				}
			}

			self::delete_cookie();
			return false;
		}

		if($place === 'jibres' || $place === 'admin')
		{
			$user_detail = \dash\db\users::jibres_get_by_id($load['user_id']);

			// supervisor can login by another session
			if(isset($user_detail['permission']) && $user_detail['permission'] === 'supervisor')
			{
				if(\dash\session::get('main_account') && \dash\session::get('main_mobile') && \dash\session::get('supervisor_login_by'))
				{
					// change user detail to new user that supervisor login by it
					$user_detail = \dash\db\users::jibres_get_by_id(\dash\session::get('supervisor_login_by'));
				}
			}

			if($place === 'admin')
			{
				if(isset($user_detail['id']))
				{
					$in_store_user = \dash\db\users::get_by_jibres_user_id($user_detail['id']);

					if(isset($in_store_user['id']))
					{
						// change id and permission
						$user_detail['user_in_store']     = true;

						$user_detail['jibres_user_id']    = $user_detail['id'];
						$user_detail['id']                = $in_store_user['id'];

						if(isset($user_detail['permission']) && $user_detail['permission'] === 'supervisor')
						{
							// supervisor
							// no change supervisor permission in store
						}
						else
						{
							$user_detail['jibres_permission'] = $user_detail['permission'];
							$user_detail['permission']        = $in_store_user['permission'];
						}
					}
				}
			}
		}
		else
		{
			$user_detail = \dash\db\users::get_by_id($load['user_id']);
			if(isset($user_detail['id']) && \dash\engine\store::inStore())
			{
				if($place === 'subdomain' || $place === 'customer_domain')
				{
					// user login in the store
					$user_detail['user_in_store'] = true;
				}
			}
		}

		\dash\user::set_detail($user_detail);

		return $user_detail;
	}


	/**
	 * Logout user by remove cookie and disable login record
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function logout()
	{
		$cookie = self::read_cookie();
		if(!$cookie)
		{
			return false;
		}

		// supervisor login by another user
		// needless to logout cookie.
		// the cookie is supervisor cookie
		// just remove session to login by her cookie
		if(\dash\session::get('main_account') && \dash\session::get('main_mobile') && \dash\session::get('supervisor_login_by'))
		{
			\dash\session::clean('main_account');
			\dash\session::clean('main_mobile');
			\dash\session::clean('supervisor_login_by');
			return;
		}

		$load = \dash\db\login\get::load_code($cookie);

		if(isset($load['id']))
		{
			\dash\db\login\update::logout($load['id']);
		}

		self::delete_cookie();
	}



	/**
	 * User change the password So must be disable all login cookie
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function change_password()
	{
		$cookie = self::read_cookie();
		if(!$cookie)
		{
			return false;
		}

		$load = \dash\db\login\get::load_code($cookie);

		if(isset($load['user_id']))
		{
			\dash\db\login\update::change_password($load['user_id'], $load['id']);
		}

		self::delete_cookie();
	}


	/**
	 * Validate login record
	 *
	 * @param      <type>   $_detail  The detail
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function validate($_detail)
	{
		if(isset($_detail['status']) && $_detail['status'] === 'active')
		{
			// ok
		}
		else
		{
			self::$error[] = 'Status of login is not active';
			self::$error[] = 'used in place  :' . self::where_am_i();
			self::$error[] = 'current url is :' . \dash\url::current();
			self::$error[] = 'the status is :' . a($_detail, 'status');
			return false;
		}

		if(!isset($_detail['user_id']))
		{
			self::$error[] = 'User id not found in login record!';
			return false;
		}

		if(!$_detail['user_id'] || !is_numeric($_detail['user_id']))
		{
			self::$error[] = 'User id is not numeric in login record';
			return false;
		}

		if(isset($_detail['place']) && $_detail['place'] === self::where_am_i())
		{
			// ok
		}
		else
		{
			if(isset($_detail['place']) && $_detail['place'] === 'jibres' && self::where_am_i() === 'admin')
			{
				// no problem
			}
			else
			{
				self::$error[] = 'place not match by login record';
				self::$error[] = 'login place is :' .$_detail['place'];
				self::$error[] = 'new place is :' . self::where_am_i();
				return false;
			}
		}

		$place = $_detail['place'];

		if(isset($_detail['trustdomain']) && $_detail['trustdomain'] === \dash\url::host())
		{
			// ok
		}
		else
		{
			self::$error[] = 'trustdomain not match by login record';
			self::$error[] = 'saved trustdomain is :' . $_detail['trustdomain'];
			self::$error[] = 'used in :' . \dash\url::host();
			return false;
		}

		if(isset($_detail['ip_md5']) && isset($_detail['agent_md5']))
		{
			// ok
		}
		else
		{
			self::$error[] = 'ip and agent not found in login record';
			return false;
		}


		$ip_md5    = md5(\dash\server::ip());
		$agent_md5 = md5(\dash\agent::get());

		$ip_ok   = false;
		$agen_ok = false;

		if($_detail['ip_md5'] === $ip_md5)
		{
			$ip_ok = true;
		}

		if($_detail['agent_md5'] === $agent_md5)
		{
			$agen_ok = true;
		}

		if($ip_ok && $agen_ok)
		{
			// ok
		}
		else
		{
			if(!$ip_ok && !$agen_ok)
			{
				self::$error[] = 'ip and agnet is changed';
				return false;
			}

			// ip is changed must be save new ip
			if(!$ip_ok)
			{
				$myIp      = \dash\server::ip();
				$ip_md5    = md5($myIp);
				$agent_md5 = md5(\dash\agent::get());
				$ip_id     = \dash\utility\ip::id($myIp);
				$agent_id  = \dash\agent::get(true);

				$insert_login_ip =
				[
					'login_id'    => $_detail['id'],
					'ip'          => $myIp,
					'ip_id'       => $ip_id,
					'agent_id'    => $agent_id,
					'datecreated' => date("Y-m-d H:i:s"),
				];

				$login_update =
				[
					'ip'             => $myIp,
					'ip_id'          => $ip_id,
					'ip_md5'         => $ip_md5,
					'agent_id'       => $agent_id,
					'agent_md5'      => $agent_md5,
				];

				$fuel = null;

				if($place === 'jibres' || $place === 'admin')
				{
					$fuel = 'master';
				}

				\dash\db\login\insert::new_record_login_ip($insert_login_ip, $fuel);
				\dash\db\login\update::update($login_update, $_detail['id'], $fuel);


			}

			if(!$agen_ok)
			{
				// if(\dash\url::isLocal())
				// {
				// 	// nothing in local change agent. for test and debug pwa mode
				// }
				// else
				// {
				// 	self::$error[] = 'only agent is changed';
				// 	return false;
				// }
			}
		}

		if(isset($_detail['datecreated']) && $_detail['datecreated'])
		{
			// ok
			$one_month = 60*60*24*30;

			if(time() - strtotime($_detail['datecreated']) > $one_month)
			{
				self::$error[] = 'More than 1 month passed from login date created';
				return false;
			}
		}
		else
		{
			self::$error[] = 'Login record have not date created!';
			return false;
		}

		return true;
	}


	/**
	 * Delete cookie
	 */
	private static function delete_cookie()
	{
		\dash\utility\cookie::delete(self::cookie_name());
	}


	/**
	 * Show place of user
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function where_am_i()
	{
		$place = null;
		if(\dash\engine\store::inBusinessDomain())
		{
			$place = 'customer_domain';
		}
		elseif(\dash\engine\store::inBusinessSubdomain())
		{
			$place = 'subdomain';
		}
		elseif(\dash\engine\store::inBusinessAdmin())
		{
			$place = 'admin';
		}
		elseif(\dash\engine\store::free_subdomain())
		{
			switch (\dash\url::subdomain())
			{
				// case 'developers':
				// case 'api':
				// case 'shop':
				case 'core':
					$place = 'api_core';
					break;

				case 'business':
					$place = 'api_business';
					break;

				default:
					$place = null;
					break;
			}
		}
		else
		{
			$place = 'jibres';
		}

		return $place;
	}


	/**
	 * Init user
	 * After login success this function is called
	 * Set the login cookie
	 *
	 * @param      <type>   $_user_id  The user identifier
	 * @param      <type>   $_place    The place
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function init($_user_id, $_place = null)
	{
		if(!$_place)
		{
			$place = self::where_am_i();
		}
		else
		{
			$place = $_place;
		}

		$place = \dash\validate::enum($place, false, ['enum' => ['jibres', 'subdomain', 'admin', 'customer_domain', 'api_core', 'api_business', 'telegram']]);
		if(!$place)
		{
			\dash\log::oops('login:placeLoginIsRequired');
			return false;
		}

		$load_user = [];

		$need_login_record = true;

		switch ($place)
		{
			case 'jibres':
			case 'admin':
				$load_user  = \dash\db\users::jibres_get_by_id($_user_id);
				break;

			case 'api_core':
				$load_user  = \dash\db\users::jibres_get_by_id($_user_id);
				$need_login_record = false;
				break;

				// in telegram we have not cookie and return user detail
			case 'telegram':
				$load_user  = \dash\db\users::get_by_id($_user_id);
				return $load_user;

				break;

			case 'api_business':
				$load_user  = \dash\db\users::get_by_id($_user_id);

				// set user in stroe because have not cookie to check and set this variable
				if(isset($load_user['id']))
				{
					$load_user['user_in_store'] = true;
				}

				$need_login_record = false;
				break;

			case 'subdomain':
			case 'customer_domain':
			default:
				$load_user  = \dash\db\users::get_by_id($_user_id);
				break;
		}

		if(!$load_user || !is_array($load_user))
		{
			\dash\log::oops('login:initUserNotFound');
			return false;
		}

		if($need_login_record)
		{
			$code      = self::generate_login_code($_user_id, $load_user);
			$myIp      = \dash\server::ip();
			$ip_md5    = md5($myIp);
			$agent_md5 = md5(\dash\agent::get());
			$ip_id     = \dash\utility\ip::id($myIp);
			$agent_id  = \dash\agent::get(true);

			$insert_login_record =
			[
				'code'           => $code,
				'user_id'        => $_user_id,
				// 'jibres_user_id' => $_user_id,
				'ip'             => \dash\server::ip(),
				'ip_id'          => $ip_id,
				'ip_md5'         => $ip_md5,
				'agent_id'       => $agent_id,
				'agent_md5'      => $agent_md5,
				'status'         => 'active',
				'place'          => $place,
				'trustdomain'    => \dash\url::host(),
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$login_id = \dash\db\login\insert::new_record($insert_login_record);

			if(!$login_id)
			{
				\dash\log::oops('login:canNotInsertLoginRecord');
				return false;
			}

			$insert_login_ip =
			[
				'login_id'    => $login_id,
				'ip'          => $myIp,
				'ip_id'       => $ip_id,
				'agent_id'    => $agent_id,
				'datecreated' => date("Y-m-d H:i:s"),
			];

			\dash\db\login\insert::new_record_login_ip($insert_login_ip);

			$load_user_ready = $load_user;

			unset($load_user_ready['permission']); //! just for not return false in check permission

			$load_user_ready = \dash\app\user::ready($load_user_ready);
			// if user set save remember set cookie life time for 1 month
			if(isset($load_user_ready['forceremember']) && $load_user_ready['forceremember'])
			{
				$time = (60*60*24*30);
			}
			else
			{
				$time = null;
			}


			\dash\utility\cookie::write(self::cookie_name(), $code, $time);
		}

		return $load_user;

	}


	/**
	 * Generate login cookie
	 *
	 * @param      <type>  $_user_id      The user identifier
	 * @param      <type>  $_user_detail  The user detail
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function generate_login_code($_user_id, $_user_detail)
	{
		$code = '';
		$code .= json_encode($_user_detail);
		$code .= '$_<3_$';
		$code .= $_user_id;
		$code .= time();
		$code .= rand();
		$code .= rand();
		$code .= rand();
		$code = md5($code);
		$code = \dash\utility::hasher($code);
		$code = \dash\validate::string_100($code, false);
		return $code;
	}


	/**
	 * Retrun cookie name by check place
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function cookie_name()
	{
		$place = self::where_am_i();

		$cookie_name = null;

		if($place === 'subdomain')
		{
			if(\dash\url::subdomain())
			{
				$cookie_name = 'jibres_login_'. \dash\url::subdomain();
			}
			else
			{
				$cookie_name = 'jibres_login';
			}
		}
		else
		{
			$cookie_name = 'jibres_login';
		}

		return $cookie_name;
	}


	/**
	 * Reads login cookie.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function read_cookie()
	{
		$cookie = \dash\utility\cookie::read(self::cookie_name());
		if($cookie)
		{
			$cookie = \dash\validate::string_100($cookie, false);
		}

		if($cookie)
		{
			return $cookie;
		}

		return null;
	}


	/**
	 * Terminate all login session
	 *
	 * @param      <type>   $_user_id  The user identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function terminate_all_other_session($_user_id)
	{
		$user_id = \dash\validate::id($_user_id, false);

		if(!$user_id)
		{
			return false;
		}

		$current_login_id = null;

		$cookie = self::read_cookie();

		if($cookie)
		{
			$load = \dash\db\login\get::load_code($cookie);

			if(isset($load['id']))
			{
				$current_login_id = $load['id'];
			}
		}

		\dash\db\login\update::terminate_all_other_session($user_id, $current_login_id);

		\dash\log::set('sessionTerminateAllOther');
		\dash\notif::ok(T_("All other session terminated"));
		return true;
	}


	/**
	 * Terminate one login session by id
	 *
	 * @param      <type>   $_id       The identifier
	 * @param      <type>   $_user_id  The user identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function terminate_id($_id, $_user_id)
	{
		$user_id = \dash\validate::id($_user_id, false);

		if(!$user_id)
		{
			return false;
		}

		$id = \dash\validate::id($_id, false);

		if(!$id)
		{
			return false;
		}

		\dash\log::set('sessionTerminateByID');
		\dash\db\login\update::terminate_id($id, $user_id);
		\dash\notif::ok(T_("Session terminated"));
		return true;
	}


	/**
	 * Gets the active sessions.
	 *
	 * @param      <type>         $_user_id  The user identifier
	 *
	 * @return     array|boolean  The active sessions.
	 */
	public static function get_active_sessions($_user_id)
	{
		$user_id = \dash\validate::id($_user_id, false);

		if(!$user_id)
		{
			return false;
		}

		$list = \dash\db\login\get::get_active_sessions($user_id);

		if(!is_array($list))
		{
			$list = [];
		}


		$current_code = self::read_cookie();

		$mySessionData = [];
		foreach ($list as $key => $row)
		{
			$mySessionData[$key]['id']          = $row['id'];
			$mySessionData[$key]['code']        = $row['code'];
			$mySessionData[$key]['ip']          = $row['ip'];
			$mySessionData[$key]['browser']     = T_(ucfirst($row['agent_name']));
			$mySessionData[$key]['browserVer']  = $row['agent_version'];
			$mySessionData[$key]['os']          = $row['agent_os'];
			$mySessionData[$key]['osName']      = T_($row['agent_os']);
			$mySessionData[$key]['osVer']       = T_($row['agent_osnum']);
			$mySessionData[$key]['agent']       = $row['agent_agent'];
			$mySessionData[$key]['datecreated'] = $row['datecreated'];

			if($current_code && $row['code'] === $current_code)
			{
				$mySessionData[$key]['current_session'] = true;
			}


			if(isset($row['agent_os']))
			{
				switch ($row['agent_os'])
				{
					case 'nt':
						$mySessionData[$key]['os'] = 'Windows';
						$mySessionData[$key]['osName'] = T_('Windows');
						break;

					case 'lin':
						$mySessionData[$key]['os'] = 'Linux';
						$mySessionData[$key]['osName'] = T_('Linux');
						break;

					default:
						break;
				}
			}
		}

		return $mySessionData;
	}



}
?>