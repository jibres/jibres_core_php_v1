<?php
namespace dash;


class log
{
	private static $temp_log        = [];
	private static $from_detail     = [];
	private static $all_user_detail = [];


	public static function debug_line()
	{
		$args =
		[
			'func_get_args' => func_get_args(),
			'notif'         => \dash\notif::get(),
		];
		$args = json_encode($args);

		\dash\log::file($args, 'debug_line', 'debug');
	}

	/**
	 * Critical error
	 *
	 * @param      <type>  $_type  The type
	 */
	public static function oops($_type = null, $_msg = null)
	{
		\dash\log::set('criticalErrorOops!');
		self::to_supervisor('criticalErrorOops: '. $_type);

		if($_msg)
		{
			\dash\notif::error($_msg);
		}
		else
		{
			\dash\notif::error(T_("Oops! We cannot complete your request. Please contact to administrator"));
		}
		return false;
	}


	public static function send_sms($_user_id, $_text)
	{
		$log =
		[
			'to' => $_user_id,
			'my_text' => $_text,
		];

		\dash\log::set('sendNotifBySms', $log);
	}


	public static function send_notif($_user_id, $_text)
	{
		$log =
		[
			'to' => $_user_id,
			'my_text' => $_text,
		];

		\dash\log::set('sendNotif', $log);
	}


	public static function to_supervisor($_text)
	{
		$log =
		[
			'my_text'    => $_text,
			'my_domain'  => \dash\url::domain(),
			'active_bot' => 'jibres_bot',
		];

		\dash\log::set('sendToSupervisor', $log, ['fuel' => 'master']);
	}



	public static function temp_set($_caller, $_args)
	{
		self::$temp_log[$_caller] = $_args;
	}


	public static function save_temp($_option = [])
	{
		foreach (self::$temp_log as $key => $value)
		{
			if(isset($_option['replace']) && is_array($_option['replace']))
			{
				self::set($key, array_merge($value, $_option['replace']));
			}
			else
			{
				self::set($key, $value);
			}
		}
		self::$temp_log = [];
	}


	public static function set($_caller, $_args = [], $_option = [])
	{
		$data  = [];
		$field = [];

		if(!is_array($_args))
		{
			$_args = [$_args];
		}

		$before_add = self::call_fn($_caller, 'before_add', $_args);

		$save_user_detail = self::call_fn($_caller, 'save_user_detail');

		if($save_user_detail && \dash\user::id())
		{
			$temp = [];

			$temp['id']            = \dash\user::detail('id');
			$temp['username']      = \dash\user::detail('username');
			$temp['displayname']   = \dash\user::detail('displayname');
			$temp['gender']        = \dash\user::detail('gender');
			$temp['gender_string'] = \dash\user::detail('gender_string');
			$temp['mobile']        = \dash\user::detail('mobile');
			$temp['verifymobile']  = \dash\user::detail('verifymobile');
			$temp['status']        = \dash\user::detail('status');
			$temp['avatar']        = \dash\user::detail('avatar');
			$temp['datecreated']   = \dash\user::detail('datecreated');
			$temp['datemodified']  = \dash\user::detail('datemodified');
			$temp['fullname']      = \dash\user::detail('fullname');

			$data['log_user_detail'] = $temp;

		}

		if(is_array($before_add))
		{
			$_args = array_merge($_args, $before_add);
		}

		$is_notif = self::call_fn($_caller, 'is_notif', $_args);

		$field['notif'] = $is_notif ? 1 : null;

		$log_type = self::call_fn($_caller, 'log_type');

		if($log_type)
		{
			$field['type'] = $log_type;
		}

		if($is_notif)
		{

			$expire = self::call_fn($_caller, 'expire');

			if(!$expire)
			{
				$expire = date("Y-m-d H:i:s", strtotime("+365 days"));
			}

			$field['expiredate'] = $expire;
		}

		if(isset($_args['from']) && is_numeric($_args['from']))
		{
			$field['from'] = $_args['from'];
		}
		elseif(\dash\user::id())
		{
			$field['from'] = \dash\user::id();
		}
		elseif(\dash\utility\enter::user_id())
		{
			// user not login but loaded detail
			$field['from'] = \dash\utility\enter::user_id();
		}

		if(!isset($field['from']) || (isset($field['from']) && !$field['from']))
		{
			$field['from'] = null;
		}

		self::set_from($field['from']);

 		foreach ($_args as $key => $value)
		{
			switch ($key)
			{
				case 'notif':
				case 'subdomain':
				case 'status':
				case 'code':
				case 'send':
				case 'readdate':
				case 'telegram':
				case 'sms':
				case 'email':
				case 'meta':
				case 'expiredate':
				case 'to':
				case 'from':
				case 'type':
					$field[$key] = $value;
					break;

				default:
					$data[$key] = $value;
					break;
			}
		}

		$new_args         = $field;

		$active_bot = self::call_fn($_caller, 'active_bot');

		if($active_bot)
		{
			$data['active_bot'] = $active_bot;
		}

		if(!empty($data))
		{
			$new_args['data'] = $data;
		}



		if($is_notif)
		{
			return self::notif($_caller, $new_args, $_option);
		}
		else
		{
			return self::db($_caller, $new_args, [], $_option);
		}
	}

	private static function set_from($_user_id)
	{
		if($_user_id)
		{
			$detail = [];
			if(floatval($_user_id) === floatval(\dash\user::id()))
			{
				$detail = \dash\user::detail();
			}
			else
			{
				$detail = \dash\db\users::get_by_id($_user_id);

			}
			self::$from_detail = $detail;
			return true;
		}
	}

	public static function from_id($_encode = false)
	{
		$id = self::from_detail('id');
		if($_encode && $id)
		{
			$id = \dash\coding::encode($id);
		}
		return $id;
	}

	public static function from_name()
	{
		return self::from_detail('displayname');
	}

	public static function from_detail($_key = null)
	{
		if($_key)
		{
			if(array_key_exists($_key, self::$from_detail))
			{
				return self::$from_detail[$_key];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$from_detail;
		}
	}


	public static function call_fn($_class, $_fn, $_args = [], $_args2 = [])
	{
		$folder = null;
		if(\dash\str::strpos($_class, '_') !== false)
		{
			$folder = substr($_class, 0, \dash\str::strpos($_class, '_'));
		}

		if($folder)
		{
			$project_function = ["\\lib\\app\\log\\caller\\$folder\\$_class", $_fn];
			$dash_function    = ["\\dash\\app\\log\\caller\\$folder\\$_class", $_fn];
		}
		else
		{
			$project_function = ["\\lib\\app\\log\\caller\\$_class", $_fn];
			$dash_function    = ["\\dash\\app\\log\\caller\\$_class", $_fn];
		}

		if(is_callable($project_function))
		{
			$namespace       = $project_function[0];
			$function        = $project_function[1];
			$result_function = $namespace::$function($_args, $_args2);
			return $result_function;
		}
		elseif(is_callable($dash_function))
		{
			$namespace       = $dash_function[0];
			$function        = $dash_function[1];
			$result_function = $namespace::$function($_args, $_args2);
			return $result_function;
		}

		return null;
	}


	private static function notif($_caller, &$_args, $_option = [])
	{
		// notifread
		// notifexpire
		if(isset($_args['status']) && $_args['status'])
		{
			// the status was set
		}
		else
		{
			$_args['status'] = 'notif';
		}

		$send_to             = self::call_fn($_caller, 'send_to');
		$send_to_creator     = self::call_fn($_caller, 'send_to_creator');

		$not_send_supervisor = self::call_fn($_caller, 'not_send_supervisor');
		$not_send_admin      = self::call_fn($_caller, 'not_send_admin');

		$must_send_to = [];

		if(isset($_args['to']) && is_numeric($_args['to']))
		{
			$to = \dash\db\users::get_by_id($_args['to']);
			if(is_array($to) && $to)
			{
				$must_send_to[$_args['to']] = $to;
			}
		}
		elseif(isset($_args['to']) && is_array($_args['to']))
		{
			$to = $_args['to'];
			$to = array_map('intval', $to);
			$to = array_filter($to);
			$to = array_unique($to);
			if($to)
			{
				$to = implode(',', $to);
				$to = \dash\db\users::get_by_multi_id($to);

				if($to && is_array($to))
				{
					foreach ($to as $key => $value)
					{
						$must_send_to[$value['id']] = $value;
					}
				}

			}
		}

		if($send_to_creator && \dash\user::id())
		{
			$must_send_to[\dash\user::id()] = \dash\user::detail();
		}

		if($send_to)
		{
			$user_detail = self::detect_user($send_to, $not_send_admin, $not_send_supervisor, $_option);

			if($user_detail)
			{
				$must_send_to = array_merge($must_send_to, $user_detail);
			}
		}

		if(!empty($must_send_to))
		{
			if(count($must_send_to) === count(array_column($must_send_to, 'id')))
			{
				$must_send_to = array_combine(array_column($must_send_to, 'id'), $must_send_to);

				$send_args    = self::create_text($_caller, $_args, $must_send_to);

				return self::db($_caller, $_args, $send_args, $_option);
			}
		}

		return self::db($_caller, $_args, [], $_option);

	}


	private static function create_text($_caller, &$_args, $_user_detail)
	{
		$new_args = [];

		if(!is_array($_user_detail))
		{
			return [];
		}

		// set to all user
		foreach ($_user_detail as $key => $value)
		{
			$new_args[$key]['to']       = $key;
		}

		$master_lang = \dash\language::current();

		$telegram      = self::call_fn($_caller, 'telegram', $_args);

		if($telegram)
		{
			foreach ($_user_detail as $key => $value)
			{
				if(isset($value['mobile']) && \dash\validate::mobile($value['mobile'], false))
				{

					$current_lang = \dash\language::current();

					if(isset($value['language']) && mb_strlen($value['language']) === 2 && $value['language'] !== $current_lang)
					{
						\dash\language::set_language($value['language']);
					}

					$telegram_text = self::call_fn($_caller, 'telegram_text', $_args, null);

					if($telegram_text)
					{
						$new_args[$key]['telegram'] = json_encode($telegram_text);
					}
				}
			}
		}


		$sms      = self::call_fn($_caller, 'sms', $_args);

		if($sms)
		{
			foreach ($_user_detail as $key => $value)
			{
				if(isset($value['mobile']) && \dash\validate::mobile($value['mobile'], false))
				{
					$sms_user      = self::call_fn($_caller, 'sms_user', $value['id']);

					if($sms_user === false)
					{
						continue;
					}

					$current_lang = \dash\language::current();

					if(isset($value['language']) && mb_strlen($value['language']) === 2 && $value['language'] !== $current_lang)
					{
						\dash\language::set_language($value['language']);
					}

					$sms_text = self::call_fn($_caller, 'sms_text', $_args, $value['mobile']);
					if($sms_text)
					{
						$new_args[$key]['sms'] = $sms_text;
					}

					// $sms_text_array = json_decode($sms_text, true);
					// if(isset($sms_text_array['mobile']) && isset($sms_text_array['text']))
					// {
					// 	// save into sms send
					// 	\lib\app\sms\queue::add_one(['mobile' => $sms_text_array['mobile'], 'message' => $sms_text_array['text']]);
					// }
				}
			}
		}

		$email      = self::call_fn($_caller, 'email', $_args);

		if($email)
		{
			foreach ($_user_detail as $key => $value)
			{
				if(isset($value['email']))
				{
					$current_lang = \dash\language::current();

					if(isset($value['language']) && mb_strlen($value['language']) === 2 && $value['language'] !== $current_lang)
					{
						\dash\language::set_language($value['language']);
					}

					$email_text = self::call_fn($_caller, 'email_text', $_args, $value['email']);
					if($email_text)
					{
						$new_args[$key]['email'] = $email_text;
					}
				}
			}
		}

		\dash\language::set_language($master_lang);

		return $new_args;
	}


	private static function detect_user($_send_to, $_not_send_admin = false, $_not_send_supervisor = false, $_option = [])
	{
		$all_user_detail = [];

		if($_send_to && is_array($_send_to))
		{
			$permission_list = [];
			foreach ($_send_to as $key => $value)
			{
				if($value === 'supervisor')
				{
					if(!$_not_send_supervisor)
					{
						$permission_list[] = 'supervisor';
					}
				}
				elseif($value === 'admin')
				{
					if(!$_not_send_admin)
					{
						$permission_list[] = 'admin';
					}

					if(!$_not_send_supervisor)
					{
						$permission_list[] = 'supervisor';
					}
				}
				else
				{
					$temp   = \dash\permission::who_have($value, !$_not_send_admin);

					if(!$_not_send_supervisor)
					{
						$temp[] = 'supervisor';
					}

					if(!empty($temp))
					{
						$permission_list = array_merge($permission_list, $temp);
					}
				}
			}

			$permission_list = array_filter($permission_list);
			$permission_list = array_unique($permission_list);

			if(!empty($permission_list))
			{
				$permission_list = implode("','", $permission_list);
			}

			$fuel = null;
			if(isset($_option['fuel']) && $_option['fuel'])
			{
				$fuel = $_option['fuel'];
			}

			$temp = \dash\db\users::get_by_permission_list_active($permission_list, $fuel);

			if(!is_array($temp))
			{
				$temp = [];
			}

			$all_user_detail = array_merge($all_user_detail, $temp);
		}

		if(empty($all_user_detail))
		{
			return false;
		}

		// to remove duplicate if exist
		$all_user_detail       = array_combine(array_column($all_user_detail, 'id'), $all_user_detail);

		self::$all_user_detail = $all_user_detail;

		return $all_user_detail;
	}



	// save log in database
	public static function db($_caller, $_args = [], $_multi_send = [], $_option = [])
	{
		$get_sql_string = false;
		if(isset($_args['data']['get_sql_string']) && $_args['data']['get_sql_string'])
		{
			unset($_args['data']['get_sql_string']);
			$get_sql_string = true;
		}

		$default_args =
		[
			'from'       => null,
			'to'         => null,
			'subdomain'  => null,
			'data'       => null,
			'status'     => 'enable',
			'code'       => null,
			'type'       => null,
			'send'       => null,
			'notif'      => null,
			'expiredate' => null,
			'from'       => null,
			'readdate'   => null,
			'meta'       => null,
			'sms'        => null,
			'telegram'   => null,
			'email'      => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_args, $_args);


		if($_args['data'])
		{
			$_args['data'] = \dash\safe::safe($_args['data'], 'raw');

			if(is_array($_args['data']) || is_object($_args['data']))
			{
				$_args['data'] = json_encode($_args['data'], JSON_UNESCAPED_UNICODE);
			}
		}
		else
		{
			$_args['data'] = null;
		}

		if($_args['meta'])
		{
			$_args['meta'] = \dash\safe::safe($_args['meta'], 'raw');

			if(is_array($_args['meta']) || is_object($_args['meta']))
			{
				$_args['meta'] = json_encode($_args['meta'], JSON_UNESCAPED_UNICODE);
			}
		}
		else
		{
			$_args['meta'] = null;
		}

		if($_caller && mb_strlen($_caller) >= 200)
		{
			$_caller = substr($_caller, 0, 198);
		}

		if($_args['code'] && mb_strlen($_args['code']) >= 200)
		{
			$_args['code'] = substr($_args['code'], 0, 198);
		}

		$insert_log =
		[
			'caller'      => $_caller,
			'from'        => $_args['from'],
			'to'          => $_args['to'],
			'datecreated' => date("Y-m-d H:i:s"),
			'subdomain'   => $_args['subdomain'],
			'visitor_id'  => \dash\utility\visitor::id(),
			'data'        => $_args['data'],
			'status'      => $_args['status'],
			'code'        => $_args['code'],
			'type'        => $_args['type'],
			'send'        => $_args['send'],
			'expiredate'  => $_args['expiredate'],
			'notif'       => $_args['notif'],
			'readdate'    => $_args['readdate'],
			'meta'        => $_args['meta'],
			'ip'          => \dash\server::iplong(),
			'sms'         => $_args['sms'],
			'telegram'    => $_args['telegram'],
			'email'       => $_args['email'],
			'ip_id'       => \dash\utility\ip::id(),
			'agent_id'    => \dash\agent::get(true),
		];
		// we need to sql raw to insert multi record in send group notifications
		if($get_sql_string)
		{
			return $insert_log;
		}

		$fuel = null;

		if(isset($_option['fuel']) && $_option['fuel'])
		{
			$fuel = $_option['fuel'];
		}

		if($_multi_send)
		{
			$multi_record = [];
			foreach ($_multi_send as $key => $value)
			{
				$multi_record[] = array_merge($insert_log, $value);
			}

			if(!empty($multi_record))
			{
				$log_id = \dash\db\logs::multi_insert($multi_record, $fuel);

				self::detect_sending_queue($multi_record);

				return $log_id;
			}
		}
		else
		{
			$log_id = \dash\db\logs::insert($insert_log, $fuel);

			self::detect_sending_queue([$insert_log]);

			return $log_id;
		}
	}


	private static function detect_sending_queue($_args)
	{
		$sending_queue =
		[
			'telegram' => [],
			'sms'      => [],
			'email'    => [],
		];


		foreach ($_args as $key => $value)
		{
			$user_mobile = null;

			if(isset($value['to']) && $value['to'])
			{
				$user_mobile = a(self::$all_user_detail, $value['to'], 'mobile');
			}

			if(!$user_mobile && a($value, 'sms'))
			{
				$temp_sms = json_decode($value['sms'], true);
				if(a($temp_sms, 'mobile'))
				{
					$user_mobile = $temp_sms['mobile'];
				}
			}

			if(!$user_mobile && a($value, 'to'))
			{
				$load_user_mobile = \dash\db\users::get_by_id($value['to']);
				if(isset($load_user_mobile['mobile']))
				{
					$user_mobile = $load_user_mobile['mobile'];
				}
			}

			if(isset($value['sms']) && $value['sms'])
			{
				$sending_queue['sms'][] = ['mobile' => $user_mobile, 'sms' => json_decode($value['sms'], true)];
			}

			if(isset($value['telegram']) && $value['telegram'])
			{
				$data = [];
				if(isset($value['data']) && $value['data'])
				{
					$data = json_decode($value['data'], true);
				}

				$sending_queue['telegram'][] =
				[
					'mobile'     => $user_mobile,
					'active_bot' => a($data, 'active_bot'),
					'telegram'   => json_decode($value['telegram'], true)
				];
			}

			if(isset($value['email']) && $value['email'])
			{
				$sending_queue['email'][] = ['mobile' => $user_mobile, 'email' => json_decode($value['email'], true)];
			}
		}


		if(!\dash\engine\store::inStore())
		{
			// save db record

			// save sms db record
			foreach ($sending_queue['sms'] as $key => $value)
			{
				if(isset($value['sms']['mobile']) && isset($value['sms']['text']))
				{
					// save into sms send
					\lib\app\sms\queue::add_one(['mobile' => $value['sms']['mobile'], 'message' => $value['sms']['text']]);
				}
			}

			// save telegram db record
			foreach ($sending_queue['telegram'] as $key => $value)
			{
				if(isset($value['mobile']) && isset($value['telegram']))
				{
					// save into telegram send
					\dash\app\telegram\queue::add_one($value['mobile'], $value['telegram'], ['active_bot' => a($value, 'active_bot')]);
				}
			}

		}
		else
		{

			// save sms db record
			foreach ($sending_queue['sms'] as $key => $value)
			{
				if(isset($value['sms']['mobile']) && isset($value['sms']['text']))
				{
					// save into sms send
					$sending_queue['sms'][$key]['sms_param'] = \lib\app\sms\queue::add_one(['mobile' => $value['sms']['mobile'], 'message' => $value['sms']['text']], ['return_args' => true]);
				}
			}

			// skipp send sms in live api
			// sms send by crontab
			// if(!empty($sending_queue['telegram']) || !empty($sending_queue['email']))
			if(!empty($sending_queue['sms']) || !empty($sending_queue['telegram']) || !empty($sending_queue['email']))
			{
				$result = \lib\api\jibres\api::send_multiple_notif($sending_queue);

				self::save_multiple_notif_result($result);

			}
		}

	}


	/**
	 * Saves a multiple notif result.
	 *
	 * @param      <type>  $_result  The result
	 */
	public static function save_multiple_notif_result($_result)
	{
		$result = $_result;

		if(!$result || !is_array($result))
		{
			return;
		}

		$telegram = a($result, 'result', 'telegram');

		if(!is_array($telegram))
		{
			$telegram = [];
		}

		$sms = a($result, 'result', 'sms');

		if(!is_array($sms))
		{
			$sms = [];
		}

		foreach ($telegram as $key => $value)
		{
			if(a($value, 'result') && ($mobile = a($value, 'args', 'mobile')))
			{
				$user_detail = \dash\db\users::get_by_mobile($mobile);

				if(isset($user_detail['id']))
				{
					$user_chat_ids = \dash\db\user_telegram::get(['user_id' => $user_detail['id']]);

					if(!$user_chat_ids)
					{
						foreach (a($value, 'result') as $k => $v)
						{
							$insert_chat_id =
							[
								'user_id'    => $user_detail['id'],
								'chatid'     => a($v, 'chatid'),
								'firstname'  => a($v, 'firstname'),
								'lastname'   => a($v, 'lastname'),
								'username'   => a($v, 'username'),
								'language'   => a($v, 'language'),
								'status'     => a($v, 'status'),
								'lastupdate' => a($v, 'lastupdate'),
							];

							\dash\db\user_telegram::insert($insert_chat_id);
						}
					}
					else
					{

						foreach ($user_chat_ids as $saved_chat_id)
						{
							foreach ($value['result'] as $jibres_chat_id)
							{
								if(strval(a($jibres_chat_id, 'chatid')) === strval(a($saved_chat_id, 'chatid')))
								{
									$must_update = [];

									if(a($jibres_chat_id, 'firstname') != a($saved_chat_id, 'firstname'))
									{
										$must_update['firstname'] = $jibres_chat_id['firstname'];
									}

									if(a($jibres_chat_id, 'lastname') != a($saved_chat_id, 'lastname'))
									{
										$must_update['lastname'] = $jibres_chat_id['lastname'];
									}

									if(a($jibres_chat_id, 'username') != a($saved_chat_id, 'username'))
									{
										$must_update['username'] = $jibres_chat_id['username'];
									}

									if(a($jibres_chat_id, 'language') != a($saved_chat_id, 'language'))
									{
										$must_update['language'] = $jibres_chat_id['language'];
									}

									if(a($jibres_chat_id, 'status') != a($saved_chat_id, 'status'))
									{
										$must_update['status'] = $jibres_chat_id['status'];
									}

									if(a($jibres_chat_id, 'lastupdate') != a($saved_chat_id, 'lastupdate'))
									{
										$must_update['lastupdate'] = $jibres_chat_id['lastupdate'];
									}


									if(!empty($must_update))
									{
										\dash\db\user_telegram::update($must_update, $saved_chat_id['id']);
									}

								}
							}
						}
					}
				}
			}
		}

		foreach ($sms as $key => $value)
		{
			if(($jibres_sms_id = a($value, 'result', 'id')) && ($sms_store_smslog_id = a($value, 'args', 'sms_param', 'store_smslog_id')) && ($jibres_sms_status = a($value, 'result', 'status')))
			{
				$update_sms                  = [];
				$update_sms['status']        = $jibres_sms_status;
				$update_sms['jibres_sms_id'] = $jibres_sms_id;
				\lib\db\sms_log\update::record($update_sms, $sms_store_smslog_id);
			}
		}


	}


	public static function file($_text, $_file_name = null, $_folder = null, $_raw = false)
	{
		if(!$_file_name)
		{
			$_file_name = 'log.log';
		}

		$fileAddr = YARD.'jibres_log/';

		if($_folder)
		{
			$fileAddr .=  $_folder. '/';
		}

		if(!is_dir($fileAddr))
		{
			\dash\file::makeDir($fileAddr, null, true);
		}

		$fileAddr .= $_file_name;

		if($_raw)
		{
			$my_text = $_text;
			$my_text .= "\r\n";
		}
		else
		{
			$my_text = "#". date("Y-m-d H:i:s"). ' '. str_repeat("-", 5);
			$my_text .= '@'. \dash\user::id(). ' | ';
			$my_text .= \dash\url::pwd();
			$my_text .= "\n";
			if($_text !== null)
			{
				$my_text .= $_text;
				$my_text .= "\r\n";
			}
		}

		self::append_file($fileAddr, $my_text);

	}


	public static function append_file($_addr, $_text)
	{
		@file_put_contents($_addr, $_text, FILE_APPEND);

		// check size
		$filesize = @filesize($_addr);

		// check on 1 MB
		if(floatval($filesize) > (1 * 1024 * 1024))
		{
			self::archive_log($_addr);
		}
	}


	private static function archive_log($_addr)
	{
		$pathinfo  = pathinfo($_addr);

		if(isset($pathinfo['basename']))
		{
			$basename = $pathinfo['basename'];
		}
		else
		{
			$basename = basename($_addr);
		}

		$extension = 'log';

		if(isset($pathinfo['extension']))
		{
			$extension = $pathinfo['extension'];
		}

		if(isset($pathinfo['filename']))
		{
			$filename = $pathinfo['filename'];
		}
		else
		{
			$filename = str_replace('.'. $extension, '', $basename);
		}

		if(isset($pathinfo['dirname']))
		{
			$dirname = $pathinfo['dirname'];
			$dirname .= DIRECTORY_SEPARATOR;
		}
		else
		{
			$dirname = str_replace($basename, '', $_addr);
		}

		$new_name = $filename. '_'. date("YmdHis"). '.'. $extension;

		$new_name = str_replace($basename, $new_name, $_addr);

		// archive old file
		rename($_addr, $new_name);

		$list = glob($dirname. '*.{log,txt,sql}', GLOB_BRACE);

		if(is_array($list) && $list)
		{
			$zip = [];

			foreach ($list as $file)
			{
				if(time() - filemtime($file) > (60*60*24*30))
				{
					$zip[] = $file;
				}
			}

			if(!empty($zip))
			{
				$zip_addr = $dirname. 'archive_'.date("YmdHis"). '.zip';

				\dash\utility\zip::multi_file($zip_addr, $zip);

				foreach ($zip as $file)
				{
					unlink($file);
				}
			}
		}

		self::to_supervisor('Auto archive file: '. $basename);
	}
}
?>