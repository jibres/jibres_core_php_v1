<?php
namespace dash\utility;

class enter
{
	public static $life_time_code = 60 * 2;


	public static function set_kavenegar_log_type()
	{
		// swich verify from
		switch (\dash\utility\enter::get_session('verify_from'))
		{
			case 'ask_twostep':				\dash\temp::set('kavenegar_sms_type', 'twostep');			break;
			case 'two_step_set':			\dash\temp::set('kavenegar_sms_type', 'twostepset');		break;
			case 'two_step_unset':			\dash\temp::set('kavenegar_sms_type', 'twostepunset');		break;
			case 'delete':					\dash\temp::set('kavenegar_sms_type', 'deleteaccount');		break;
			case 'recovery':				\dash\temp::set('kavenegar_sms_type', 'recovermobile');		break;
			case 'password_change':			\dash\temp::set('kavenegar_sms_type', 'changepassword');	break;
			case 'signup':		case 'set':	\dash\temp::set('kavenegar_sms_type', 'signup');			break;
		}
	}

	public static function try($_module)
	{
		$log_caller = 'enterTry:'. $_module;

		\dash\log::set($log_caller);

		$ban_try_1 = 1;
		$ban_try_2 = 10;
		$ban_try_3 = 50;

		switch ($_module)
		{
			case 'enter_invalid_force_code':
				$ban_try_1 = 1;
				$ban_try_2 = 3;
				$ban_try_3 = 5;
				break;

			case 'diffrent_mobile':
				$ban_try_1 = 100;
				$ban_try_2 = 1000;
				$ban_try_3 = 50000;
				break;

			case 'invalid_password':
			case 'verify_invalid_code':
			case 'login_user_not_found':
			case 'login_status_block':
			case 'browser_pass_saved_invalid':
			case 'change_pass_invalid_old_pass':
			case 'pass_invalid_pass':
			case 'pass_recovery_pass_not_set':
			case 'pass_set_password_not_set':
			case 'pass_signup_password_not_set':
			case 'username_username_not_set':
			case 'change_pass_have_not_pass':
				$ban_try_1 = 5;
				$ban_try_2 = 10;
				$ban_try_3 = 50;
				break;

			default:
				# code...
				break;
		}


		$check_log           = [];
		$check_log['caller'] = $log_caller;

		$user_id = (\dash\user::id()) ? \dash\user::id() : self::user_id();

		if($user_id)
		{
			$check_log['from'] = $user_id;

			$this_hour = date("Y-m-d H:i:s", (time() - (60*60)));
			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);


			if($get_count_log > $ban_try_1)
			{
				// ban user up to 1 hour

				\dash\app\user::ban($user_id, date("Y-m-d H:i:s", (time() + (60*60))));

				\dash\log::to_supervisor("User ban alert! user_id: ". $user_id. " ban for 1 hour");
				\dash\notif::error(T_("You are banned"));
				self::set_logout($user_id);
			}
			else
			{

				$today = date("Y-m-d H:i:s", strtotime("-1 days"));

				$get_count_log = \dash\db\logs::count_where_date($check_log, $today);

				if($get_count_log > $ban_try_2)
				{
					// ban user up to 24 hour

					\dash\app\user::ban($user_id, date("Y-m-d H:i:s", (time() + (60*60*24))));
					\dash\log::to_supervisor("User ban alert! user_id: ". $user_id. " ban for 24 hour");
					\dash\notif::error(T_("You are banned"));
					self::set_logout($user_id);

				}
				else
				{
					$this_month = date("Y-m-d H:i:s", strtotime("-30 days"));

					$get_count_log = \dash\db\logs::count_where_date($check_log, $this_month);

					if($get_count_log > $ban_try_3)
					{
						// ban forever.
						\dash\app\user::ban($user_id);
						\dash\log::to_supervisor("User ban alert! user_id: ". $user_id. " ban forever");
						\dash\notif::error(T_("You are banned"));
						self::set_logout($user_id);
					}
					else
					{
						// nothing
						// user is ok!
					}
				}
			}
		}


		self::set_session($_module, intval(self::get_session($_module)) + 1);

		$count_try = intval(self::get_session($_module));

		switch ($_module)
		{
			case 'enter_invalid_force_code':
				if($count_try >= 1)
				{
					\dash\log::set('userBanedIn_'. $_module);
					// ban user for 2 min
					\dash\session::set('enter_baned_user', true, null, (60 * 2));
				}
				break;
			case 'invalid_password':
			case 'verify_invalid_code':
			case 'diffrent_mobile':
			case 'login_user_not_found':
			case 'login_status_block':
			case 'browser_pass_saved_invalid':
			case 'change_pass_invalid_old_pass':
			case 'pass_invalid_pass':
			case 'pass_recovery_pass_not_set':
			case 'pass_set_password_not_set':
			case 'pass_signup_password_not_set':
			case 'username_username_not_set':
			case 'change_pass_have_not_pass':
				if($count_try > 10)
				{
					\dash\log::set('userBanedIn_'. $_module);
					// ban user for 2 min
					\dash\session::set('enter_baned_user', true, null, (60 * 2));
				}
				break;

			default:
				# code...
				break;
		}
	}


	public static function clean_session($_low = false)
	{
		if($_low)
		{
			$alert = [];

			if(\dash\session::get('alert', 'enter'))
			{
				$alert = \dash\session::get('alert', 'enter');
			}

			\dash\session::clean_cat('enter');

			\dash\session::set('alert', $alert, 'enter');
		}
		else
		{
			\dash\session::clean_cat('enter');
		}
	}


	public static function set_session($_key, $_value)
	{
		\dash\session::set($_key, $_value, 'enter');
	}


	public static function get_session($_key)
	{
		return \dash\session::get($_key, 'enter');
	}


	// user in \lib\log to set log of this user
	// this user not login yet but detail is loaded
	public static function user_id()
	{
		return self::user_data('id');
	}


	/**
	 * Loads an user data.
	 */
	public static function load_user_data($_user_aut_key, $_type = 'mobile')
	{
		$data = [];

		if(!$_user_aut_key)
		{
			return [];
		}

		switch ($_type)
		{
			case 'usernameormobile':
				$data = \dash\db\users::find_user_to_login($_user_aut_key);
				break;

			case 'mobile':
				if(\dash\validate::mobile($_user_aut_key, false))
				{
					$data = \dash\db\users::get_by_mobile($_user_aut_key);
				}
				break;

			case 'username':
				if(preg_match("/^[A-Za-z0-9\_\-]+$/", $_user_aut_key) && preg_match("/[A-Za-z]+/", $_user_aut_key))
				{
					$data = \dash\db\users::get_by_username($_user_aut_key);
				}
				break;

			case 'user_id':
				if(is_numeric($_user_aut_key))
				{
					$data = \dash\db\users::get_by_id($_user_aut_key);
				}
				break;

			case 'email':
				if(filter_var($_user_aut_key, FILTER_VALIDATE_EMAIL))
				{
					$data = \dash\db\users::get_by_email($_user_aut_key);
				}
				break;

			case 'loaded':
				$data = $_user_aut_key;
				break;

		}

		if($data)
		{
			self::set_session('user_data', $data);
		}
		return $data;
	}


	/**
	 * { function_description }
	 *
	 * @param      <type>  $_key   The key
	 */
	public static function user_data($_key = null)
	{
		if(!self::get_session('user_data'))
		{
			self::load_user_data(self::get_session('usernameormobile'), 'usernameormobile');
		}

		$user_data = self::get_session('user_data');

		if($_key)
		{
			if(isset($user_data[$_key]))
			{
				return $user_data[$_key];
			}
			return null;
		}

		if($user_data)
		{
			return $user_data;
		}

		return null;
	}


	/**
	*	Signup new user
	*/
	public static function signup($_args = [])
	{

		$default_args =
		[
			'mobile'      => null,
			'displayname' => null,
			'password'    => null,
			'email'       => null,
			'status'      => 'awaiting'
		];

		if(is_array($_args))
		{
			$_args = array_merge($default_args, $_args);
		}

		// save ref in users table
		if(\dash\session::get('ref') && !isset($_args['ref']))
		{
			$_args['ref'] = floatval(\dash\session::get('ref'));
			\dash\session::clean('ref');
		}

		$mobile = self::get_session('mobile');
		if($mobile)
		{
			// set mobile to use in other function
			$_value          = $mobile;
			$_args['mobile'] = $mobile;
			$_args['email']  = $_value;

			$user_id = \dash\app\user::quick_add($_args);

			if($user_id)
			{
				self::load_user_data($user_id, 'user_id');
			}
			else
			{
				\dash\log::set('enterCanNotSignupInDb');
				return false;
			}

			self::set_session('first_signup', true);

			return $user_id;
		}
		else
		{
			\dash\log::set('enterCanNotSignup');
			return false;
		}
	}


	/**
	*	Signup new user
	*/
	public static function signup_email($_args = [])
	{
		if(self::get_session('dont_will_set_mobile'))
		{
			// $_args['dontwillsetmobile'] = date("Y-m-d H:i:s");
		}
		else
		{
			if(self::get_session('temp_mobile') && !isset($_args['mobile']))
			{
				$_args['mobile'] = self::get_session('temp_mobile');
			}
		}

		self::set_session('first_signup', true);

		if(\dash\session::get('ref') && !isset($_args['ref']))
		{
			$_args['ref'] = floatval(\dash\session::get('ref'));
			\dash\session::clean('ref');
		}


		$user_id = \dash\app\user::quick_add($_args);

		if($user_id)
		{
			$_value = \dash\db::insert_id();
			self::load_user_data($_value, 'user_id');
		}
		return $_value;

	}

	/**
	 * find redirect url
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function find_redirect_url($_url = null)
	{
		if($_url)
		{
			return $_url;
		}

		$host = \dash\url::kingdom();

		// get url language
		// if have referer redirect to referer
		if(\dash\validate::url(\dash\request::get('referer'), false))
		{
			$host = \dash\validate::url(\dash\request::get('referer'), false);
		}
		elseif(\dash\session::get('enter_referer'))
		{
			$host = \dash\session::get('enter_referer');
			\dash\session::clean('enter_referer');
		}
		elseif(self::get_session('app_mode'))
		{
			$host .= '/enter/app?ok=true';
			self::set_session('app_mode', false);
		}
		elseif(self::get_session('first_signup'))
		{
			$host .= '/my';
		}
		else
		{
			if(\dash\engine\store::inStore())
			{
				$host .= '/';
			}
			else
			{
				$host .= '/my';
			}

		}

		return $host;
	}



	/**
	 * login
	 */
	public static function enter_set_login($_url = null, $_auto_redirect = false)
	{
		if(\dash\user::id())
		{
			$user_id = \dash\user::id();
		}
		else
		{
			$user_id = self::user_data('id');
		}

		if(!$user_id)
		{
			\dash\log::set('loginNoUserIdWasFounded');
			\dash\notif::warn(T_("User id not found to save your session"));
			return;
		}

		$twostep = self::user_data('twostep');

		if(!$twostep)
		{
			// force twostep verification for supervisor
			if(self::user_data('permission') === 'supervisor')
			{
				$twostep = true;
			}
		}

		if($twostep)
		{
			if(\dash\session::get('main_account') && \dash\session::get('main_mobile') && self::user_data('mobile') )
			{
				if(self::user_data('mobile') === \dash\session::get('main_mobile'))
				{
					if(self::get_session('twostep_is_ok'))
					{
						// no problem
					}
					else
					{
						// set session verify_from set
						\dash\utility\enter::set_session('verify_from', 'ask_twostep');

						// send code way
						\dash\utility\enter::go_to_verify();
					}
				}
				else
				{
					// if the admin user login by this user
					// not ask two-step
				}
			}
			else
			{
				if(self::get_session('twostep_is_ok'))
				{
					// no problem
				}
				else
				{
					// set session verify_from set
					\dash\utility\enter::set_session('verify_from', 'ask_twostep');

					// send code way
					\dash\utility\enter::go_to_verify();
				}
			}
		}

		\dash\user::init($user_id);

		$set_session = false;

		if(is_null(self::user_data('forceremember')))
		{
			// default of this variable is true
			$set_session = true;
		}
		elseif(is_numeric(self::user_data('forceremember')))
		{
			if(intval(self::user_data('forceremember')) === 0)
			{
				$set_session = false;
				// no login by remember
			}
			elseif(intval(self::user_data('forceremember')) === 1)
			{
				$set_session = true;

			}
		}

		$alert_notif_login = true;

		if(\dash\session::get('main_account') && \dash\session::get('main_mobile'))
		{
			if(\dash\user::detail('mobile') === \dash\session::get('main_mobile'))
			{
				// nothign
				// read $set_session
			}
			else
			{
				$alert_notif_login = false;
				// not save session for other people never
				$set_session = false;
			}
		}
		else
		{
			// check user status
			// if the user status is awaiting
			// set the user status as enable
			if(self::user_data('status') === 'awaiting' && is_numeric($user_id))
			{
				\dash\app\user::quick_update(['status' => 'active'], $user_id);
			}
		}


		$url = self::find_redirect_url($_url);

		// login by supervisor not set
		if($alert_notif_login)
		{
			$NewAccoutLogin =
			[
				'my_ip' => \dash\server::ip(true),
				'to'    => $user_id,
			];

			\dash\log::set('enter_NewAccountLogin', $NewAccoutLogin);
		}

		if(self::user_data('permission') === 'supervisor')
		{
			\dash\log::set('enter_AlertSupervisorLoginToAllSupervisor', ['my_user_id' => $user_id, 'my_detail' => \dash\db\users::get_by_id($user_id)]);
		}

		// clean enter session
		self::clean_session();


		if($_auto_redirect)
		{

			\dash\notif::direct(true);
			// go to new address
			\dash\redirect::to($url);
		}
		else
		{
			self::set_session('redirect_url', $url);
			return $url;
		}

	}


	/**
	 * Sets the logout.
	 *
	 * @param      <type>  $_user_id  The user identifier
	 */
	public static function set_logout($_user_id, $_auto_redirect = true)
	{
		\dash\utility\cookie::delete('login');

		\dash\login::logout();

		\dash\session::destroy();

		if(is_array($_COOKIE))
		{
			foreach($_COOKIE as $key => $value)
			{
				if(strpos($key, '_g') === 0)
				{
					// do nothing for google cookies
				}
				else
				{
					\dash\utility\cookie::delete($key);
				}
			}
		}

		if($_auto_redirect)
		{

			$mobile  = \dash\validate::mobile(\dash\request::get('mobile'), false);
			$referer = \dash\validate::url(\dash\request::get('referer'), false);

			if($referer || $mobile)
			{
				$get_enter_query = [];
				if($mobile)
				{
					$get_enter_query['mobile']   = $mobile;
					$get_enter_query['autosend'] = 1;
				}

				if($referer)
				{
					$get_enter_query['referer']   = $referer;
				}

				\dash\redirect::to(\dash\url::kingdom(). '/enter?'. http_build_query($get_enter_query));
			}
			else
			{
				// go to base
				self::go_to('main');
			}
		}

	}


	public static function load_chat_id($_id)
	{
		$get =
		[
			'user_id' => $_id,
			'limit'   => 1,
		];

		$result = \dash\db\user_telegram::get($get);

		if(isset($result['chatid']))
		{
			return $result['chatid'];
		}

		return null;
	}


	/**
	 * return list of way we can send code to the user
	 *
	 * @param      <type>  $_mobile_or_email  The usernameormobile
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function list_send_code_way($_mobile_or_email = null)
	{
		$mobile    = null;
		$chatid    = null;
		$email     = null;

		if($_mobile_or_email)
		{
			$mobile = $_mobile_or_email;
			$email  = $_mobile_or_email;
		}
		elseif(self::user_data('mobile') || self::user_data('email'))
		{
			// check detail from user data: new user loaded data in this session
			$mobile = self::user_data('mobile');
			$email  = self::user_data('email');
			if(self::user_data('id'))
			{
				$chatid = self::load_chat_id(self::user_data('id'));
			}
		}
		elseif(\dash\user::detail('mobile') || \dash\user::detail('email'))
		{
			// check detail from user session: user logined and data is saved in session
			$mobile = \dash\user::detail('mobile');
			$email  = \dash\user::detail('email');
			if(\dash\user::id())
			{
				$chatid = self::load_chat_id(\dash\user::id());
			}
		}
		elseif(self::get_session('signup_detail'))
		{
			$signup_detail = self::get_session('signup_detail');
			if(isset($signup_detail['mobile']))
			{
				$mobile = $signup_detail['mobile'];
			}
		}

		$way = [];

		if($email)
		{
			// load email way
			// array_push($way, 'email');
		}

		if($chatid && \dash\social\telegram\tg::setting('status'))
		{
			array_push($way, 'telegram');
		}

		if($mobile && \dash\validate::mobile($mobile, false))
		{
			array_push($way, 'sms');
			array_push($way, 'call');

			// send sms is not active for business login
			if(!\dash\engine\store::inStore())
			{
				array_push($way, 'sendsms');
			}
		}

		if(\dash\url::isLocal() && empty($way))
		{
			array_push($way, 'sms');
		}

		if(\dash\utility\enter::get_session('verify_from') === 'signup')
		{
			array_push($way, 'later');
		}

		if(empty($way))
		{
			self::next_step('verify/what');
			self::open_lock('verify/what');
			self::open_lock('verify');
			self::go_to('verify/what');
		}

		return $way;
	}


	/**
	 * Sends a code way.
	 */
	public static function go_to_verify()
	{
		$host = \dash\url::kingdom();
		$host .= '/enter/verify';
		self::open_lock('verify');
		\dash\redirect::to($host);
	}



	/**
	 * generate verification code
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function create_new_code($_way = null)
	{
		$code =  rand(10000,99999);

		if(\dash\url::isLocal())
		{
			$code = 11111;
		}

		// set verification code in session
		self::set_session('verification_code', $code);
		$time = date("Y-m-d H:i:s");

		$user_id = self::user_data('id');
		if(!$user_id && \dash\user::id())
		{
			$user_id = \dash\user::id();
		}

		$log_detail =
		[
			'to'     => $user_id,
			'send'   => 1,
			'notif'  => 1,
			'code'   => $code,
			'mycode' => $code,
			'time'   => $time,
		];

		if(in_array(self::get_session('verify_from'), ['two_step_set', 'two_step_unset', 'password_change']))
		{
			$log_detail['secret'] = true;
		}


		$log_id = \dash\log::set('enter_VerificationCode', $log_detail);

		// save this code in logs table and session
		// $log_id = \dash\db\logs::set('user:verification:code', self::user_data('id'), $log_meta);

		self::set_session('verification_code', $code);
		self::set_session('verification_code_time', $time);
		self::set_session('verification_code_way', $_way);
		self::set_session('verification_code_id', $log_id);

		return $code;
	}


	/**
	 * check code exist and live
	 */
	public static function generate_verification_code()
	{
		$date_start          = date("Y-m-d", strtotime('-2 days'));
		$date_end            = date("Y-m-d");
		$check_count_ip_code = \dash\db\logs::count_caller_ip_date('enter_VerificationCode', $date_start, $date_end);

		if($check_count_ip_code > 100)
		{
			\dash\log::to_supervisor('Too meany request of create verification code '. $check_count_ip_code);
			\dash\header::status(429, T_("Too many request for generate code"));
		}

		// check last code time and if is not okay make new code
		$last_code_ok = false;
		// get saved session last verification code

		if
		(
			self::get_session('verification_code') &&
			self::get_session('verification_code_id') &&
			self::get_session('verification_code_time')
		)
		{
			if(time() - strtotime(self::get_session('verification_code_time')) < self::$life_time_code)
			{
				// last code is true
				// need less to create new code
				$last_code_ok = true;
			}
		}


		// user code not found
		if(!$last_code_ok)
		{
			if(self::user_data('id'))
			{
				// 'enable','disable','expire','deliver','awaiting','deleted','cancel','block','notif','notifread','notifexpire'
				$where =
				[
					'caller' => 'enter_VerificationCode',
					'to'     => self::user_data('id'),
					'status' => ["IN", "('enable', 'notif', 'notifread')"],
					'limit'  => 1,
				];
				$log_code = \dash\db\logs::get($where);

				if($log_code)
				{
					if(isset($log_code['datecreated']) && time() - strtotime($log_code['datecreated']) < self::$life_time_code)
					{
						// the last code is okay
						// need less to create new code
						$last_code_ok = true;
						// save data in session
						if(isset($log_code['code']))
						{
							self::set_session('verification_code', $log_code['code']);
						}
						// save log time
						if(isset($log_code['datecreated']))
						{
							self::set_session('verification_code_time', $log_code['datecreated']);
						}

						// save log id
						if(isset($log_code['id']))
						{
							self::set_session('verification_code_id', $log_code['id']);
						}

					}
					else
					{
						// the log is exist and the time of log is die
						// we expire the log
						if(isset($log_code['id']))
						{
							\dash\db\logs::update(['status' => 'expire'], $log_code['id']);
						}
					}
				}
			}
		}
		// if last code is not okay
		// make new code
		if(!$last_code_ok)
		{
			self::create_new_code();
		}
	}



	public static function check_code($_module)
	{
		$log_meta =	[];

		$verificationCode = \dash\validate::verification_code(\dash\request::post('code'));

		if(!$verificationCode)
		{
			\dash\notif::error(T_("Please fill the verification code"), 'code');
			return false;
		}

		$verificationCode = \dash\utility\convert::to_en_number($verificationCode);

		if(!is_numeric($verificationCode))
		{
			\dash\log::set('codeStringGivenMustNumber');
			\dash\notif::error(T_("What happend? the code is number. you try to send string!?"), 'code');
			return false;
		}

		// check verification code len
		if(mb_strlen($verificationCode) !== 5)
		{
			\dash\notif::error(T_("Please enter the 5 digit code sent to your mobile phone"), 'code');
			return false;
		}

		$code_is_okay = false;
		// if the module is sendsms user not send the verification code here
		// the user send the verification code to my sms service
		// and this code is deffirent by verification code
		if($_module === 'sendsms')
		{
			$code = $verificationCode;
			if($code == self::get_session('sendsms_code'))
			{
				$log_id = self::get_session('sendsms_code_log_id');

				if($log_id)
				{
					$get_log_detail = \dash\db\logs::get(['id' => $log_id, 'limit' => 1]);
					if(!$get_log_detail || !isset($get_log_detail['status']))
					{
						\dash\db\logs::set('enter:verify:sendsmsm:log:not:found', self::user_data('id'), $log_meta);
						\dash\notif::error(T_("System error, try again"));
						return false;
					}

					switch ($get_log_detail['status'])
					{
						case 'deliver':
							// the user must be login
							\dash\db\logs::update(['status' => 'expire'], $log_id);
							$code_is_okay = true;
							// set login session
							// $redirect_url = self::enter_set_login();

							// // save redirect url in session to get from okay page
							// self::set_session('redirect_url', $redirect_url);
							// // set okay as next step
							// self::next_step('okay');
							// // go to okay page
							// self::go_to('okay');
							break;

						case 'enable':
							// user not send sms or not deliver to us
							\dash\db\logs::set('enter:verify:sendsmsm:sms:not:deliver:to:us', self::user_data('id'), $log_meta);
							\dash\notif::error(T_("Your sms not deliver to us!"));
							return false;
							break;

						case 'expire':
							// the user user from this way and can not use this way again
							// this is a bug!
							\dash\db\logs::set('enter:verify:sendsmsm:sms:expire:log:bug', self::user_data('id'), $log_meta);
							\dash\notif::error(T_("What are you doing?"));
							return false;
						default:
							// bug!
							return false;
							break;
					}
				}
				else
				{
					\dash\db\logs::set('enter:verify:sendsmsm:log:id:not:found', self::user_data('id'), $log_meta);
					\dash\notif::error(T_("What are you doing?"));
					return false;
				}
			}
			else
			{
				\dash\db\logs::set('enter:verify:sendsmsm:user:inspected:change:html', self::user_data('id'), $log_meta);
				\dash\notif::error(T_("What are you doing?"));
				return false;
			}
		}
		else
		{
			if(intval($verificationCode) === intval(self::get_session('verification_code')))
			{
				$code_is_okay = true;
			}
		}

		if(!$code_is_okay)
		{
			// wrong code sleep code
			\dash\log::set('invalidCode');
			self::try('verify_invalid_code');
			\dash\code::sleep(3);
			\dash\notif::error(T_("Wrong code entered, Please enter the 5 digit code sent to your mobile phone"), 'code');
			return false;
		}


		// expire code
		if(self::get_session('verification_code_id'))
		{
			// the user enter the code and the code is ok
			// must expire this code
			\dash\db\logs::update(['status' => 'expire'], self::get_session('verification_code_id'));
			self::set_session('verification_code', null);
			self::set_session('verification_code_time', null);
			self::set_session('verification_code_way', null);
			self::set_session('verification_code_id', null);
		}

		// to no check again
		self::set_session('twostep_is_ok', true);


		if(is_numeric(self::user_data('id')) && !self::user_data('verifymobile'))
		{
			\dash\app\user::quick_update(['verifymobile' => 1], self::user_data('id'));
		}

		if(is_numeric(\dash\user::id()) && !\dash\user::detail('verifymobile'))
		{
			\dash\app\user::quick_update(['verifymobile' => 1], \dash\user::id());
		}

		/**
		 ***********************************************************
		 * VERIFY FROM
		 * PASS/SIGNUP
		 * PASS/SET
		 * PASS/RECOVERY
		 ***********************************************************
		 */
		if(
			(
				self::get_session('verify_from') === 'signup' ||
				self::get_session('verify_from') === 'set' ||
				self::get_session('verify_from') === 'recovery'
			) &&
			self::get_session('temp_ramz_hash') &&
			is_numeric(self::user_data('id'))
		  )
		{
			\dash\log::set('PasswordOK');
			// set temp ramz in use pass
			\dash\app\user::update_password(self::get_session('temp_ramz_hash'), self::user_data('id'));
		}


		/**
		 ***********************************************************
		 * VERIFY FROM
		 * ENTER/DELETE
		 * DELETE ACCOUNT
		 ***********************************************************
		 */
		if(self::get_session('verify_from') === 'delete')
		{
			if(self::get_session('why'))
			{
				$update_meta  = [];

				$meta = \dash\user::detail('meta');
				if(!$meta)
				{
					$update_meta['why'] = self::get_session('why');
				}
				elseif(is_string($meta) && substr($meta, 0, 1) !== '{')
				{
					$update_meta['other'] = $meta;
					$update_meta['why'] = self::get_session('why');
				}
				elseif(is_string($meta) && substr($meta, 0, 1) === '{')
				{
					$json = json_decode($meta, true);
					$update_meta = array_merge($json, ['why' => self::get_session('why')]);
				}

			}

			$update_user = [];
			if(!empty($update_meta))
			{
				$update_user['meta'] = json_encode($update_meta, JSON_UNESCAPED_UNICODE);
			}
			$update_user['status'] = 'removed';

			\dash\app\user::quick_update($update_user, \dash\user::id());

			\dash\log::set('userDeletedOK');

			\dash\login::logout();

			self::next_step('byebye');
			// self::clean_session(true);
			self::go_to('byebye');
			return;
		}



		/**
		 ***********************************************************
		 * VERIFY FROM
		 * TWO STEP VERICICATION SET
		 ***********************************************************
		 */
		if(self::get_session('verify_from') === 'two_step_set' &&	is_numeric(self::user_data('id')))
		{
			// set on two_step of this user
			\dash\app\user::quick_update(['twostep' => 1], self::user_data('id'));
			$alert =
			[
				'clean_session' => true,
				'text' => T_("Your two-step verification is now active for your account"),
				'link' => \dash\url::kingdom(). '/account/security',
			];

			\dash\log::set('twoStepActive');

			\dash\login::terminate_all_other_session(self::user_data('id'));

			self::set_session('alert', $alert);
			self::next_step('alert');
			self::go_to('alert');
			return;
		}


		/**
		 ***********************************************************
		 * VERIFY FROM
		 * TWO STEP VERICICATION SET
		 ***********************************************************
		 */
		if(self::get_session('verify_from') === 'two_step_unset' &&	is_numeric(self::user_data('id')))
		{
			// set off two_step of this user
			\dash\app\user::quick_update(['twostep' => 0], self::user_data('id'));
			$alert =
			[
				'clean_session' => true,
				'text' => T_("Your two-step verification is now deactive for your account"),
				'link' => \dash\url::kingdom(). '/account/security',
			];

			\dash\log::set('twoStepDeactive');


			\dash\login::terminate_all_other_session(self::user_data('id'));

			self::set_session('alert', $alert);
			self::next_step('alert');
			self::go_to('alert');
			return;
		}


		if(self::get_session('verify_from') === 'password_change' && \dash\user::id() && self::get_session('temp_ramz_hash'))
		{

			// set off two_step of this user
			\dash\app\user::update_password(self::get_session('temp_ramz_hash'), \dash\user::id());

			\dash\login::change_password();

			$alert =
			[
				'clean_session' => true,
				'text'          => T_("Your password was changed"),
				'link'          => \dash\url::kingdom(). '/account/security',
			];

			\dash\log::set('passwordChangeOK');

			self::set_session('alert', $alert);
			// open lock of alert page
			self::next_step('alert');
			// self::clean_session(true);
			// go to alert page
			self::go_to('alert');
			return;

		}

		// set login session
		$redirect_url = self::enter_set_login();

		// save redirect url in session to get from okay page
		self::set_session('redirect_url', $redirect_url);
		// set okay as next step
		self::next_step('okay');
		// go to okay page
		self::go_to('okay');
	}


	/**
	 * Sends a code email.
	 * send verification code whit email address
	 */
	public static function send_code_email()
	{
		$email = self::get_session('temp_email');
		$code  = self::generate_verification_code();
		$mail =
		[
			'to'      => $email,
			'subject' => 'contact',
			'body'    => "salam". $code,
		];
		// $mail = \dash\mail::send($mail);
		return $mail;
	}



	/**
	 * lock or unlock step
	 * and check is lock or not lock
	 *
	 * @param      <type>  $_module  The module
	 * @param      <type>  $_acction     The set
	 */
	public static function lock($_module, $_acction = null)
	{
		if($_acction === true)
		{
			self::set_session('lock_'. $_module, true);
		}

		if($_acction === false)
		{
			self::set_session('lock_'. $_module, false);
		}

		if($_acction === null)
		{
			// in dev and when we in debug mode
			// we have not any page to lock!
			if(\dash\url::isLocal())
			{
				// return false;
			}
			// get lock from session
			$is_lock = self::get_session('lock_'. $_module);
			// if is lock or not set
			if($is_lock === true || $is_lock === null)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}


	/**
	 * Opens a lock.
	 *
	 * @param      <type>  $_module  The module
	 */
	public static function open_lock($_module)
	{
		self::lock($_module, false);
	}


	/**
	 * disable all lock page and set only this module is true
	 *
	 * @param      <type>  $_module  The module
	 */
	public static function next_step($_module)
	{
		$all_other_lock = \dash\session::get_cat('enter');

		// unset all other lock
		if(is_array($all_other_lock))
		{
			foreach ($all_other_lock as $key => $value)
			{
				if(substr($key, 0, 5) === 'lock_')
				{
					\dash\session::clean($key , 'enter');
				}
			}
		}

		// set jusn this lock
		self::set_session('lock_'. $_module, false);
	}


	/**
	 * redirect to url
	 *
	 * @param      <type>  $_url   The url
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function go_to($_url = null)
	{
		$host = \dash\url::kingdom();

		if($_url === 'okay')
		{
			\dash\notif::ok(null, ['unlock' => false]);
			\dash\notif::redirect($host. '/enter/okay');
			return;
		}

		$url  = null;
		switch ($_url)
		{
			// redirect to base
			case 'base':
				$url = $host. '/enter';
				break;

			case 'main':
				$url = $host;
				break;

			default:
				$url = $host. '/enter/'. $_url;
				break;
		}

		if($url)
		{
			\dash\redirect::to($url);
		}
	}


	/**
	 * check password syntax
	 * min
	 * max
	 *
	 * @param      <type>  $_password  The password
	 */
	public static function check_pass_syntax($_password, $_mobile_or_email = null)
	{
		// cehck min leng of password is 6 character
		if(mb_strlen($_password) < 6)
		{
			\dash\notif::error(T_("You must set 6 character and large in password"));
			return false;
		}

		// cehck max length of password
		if(mb_strlen($_password) > 99)
		{
			\dash\notif::error(T_("You must set less than 99 character in password"));
			return false;
		}

		if($_mobile_or_email)
		{
			if(strpos($_password, substr($_mobile_or_email, 2)) !== false)
			{
				\dash\notif::error(T_("Please do not use your mobile in password!"));
				return false;
			}
		}

		// no problem ;)
		return true;
	}
}
?>