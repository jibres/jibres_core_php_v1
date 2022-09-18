<?php
namespace dash\utility\pay;


class start
{

	public static function bank($_args)
	{
		$default =
			[
				'bank'  => null,
				'token' => null,
			];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default, $_args);

		$token = $_args['token'];
		if(!$token)
		{
			\dash\notif::error(T_("Invalid token"));
			return self::endCompile();
		}

		\dash\utility\pay\setting::load_token($token);

		$bank = \dash\str::mb_strtolower($_args['bank']);
		if(!$bank)
		{
			\dash\notif::error(T_("Please select one of the available ports"));
			return self::endCompile();
		}

		if(is_callable(["\\dash\\setting\\$bank", 'get']))
		{
			$bank_status = ("\\dash\\setting\\$bank")::get('status');
		}
		else
		{
			$bank_status = false;
		}

		if(!$bank_status)
		{
			\dash\notif::error(T_("This bank is disabled on this service"));
			return self::endCompile();
		}

		$banktoken = \dash\utility\pay\setting::get_banktoken();

		if($banktoken)
		{
			$duplicate_record = self::duplicate_record();

			if(!$duplicate_record)
			{
				\dash\notif::error(T_("This record is go to bank"));
				return self::endCompile();
			}
			else
			{
				\dash\utility\pay\setting::load_token($duplicate_record, true);
			}
		}

		if(is_callable(["\\dash\\utility\\pay\\api\\$bank\\go", "bank"]))
		{
			\dash\utility\pay\setting::set_payment($bank);
			\dash\utility\pay\setting::set_title(T_("Pay whit :bank", ['bank' => T_(ucfirst($bank))]));

			("\\dash\\utility\\pay\\api\\$bank\\go")::bank();
		}
		else
		{
			\dash\notif::error(T_("This payment is not supported in this system"));
		}

		return self::endCompile();
	}


	private static function duplicate_record()
	{
		$detail = \dash\utility\pay\setting::get_all();

		$payment_response = [];

		if(isset($detail['payment_response']))
		{
			$payment_response = json_decode($detail['payment_response'], true);
		}

		if(isset($payment_response['raw']) && is_array($payment_response['raw']))
		{
			$payment_response['raw']['get_token'] = true;
			$token                                = self::token($payment_response['raw'], true);
			return $token;
		}
		else
		{
			return false;
		}
	}


	public static function site($_args)
	{
		if(!is_array($_args))
		{
			$_args = [];
		}

		if(!array_key_exists('get_token', $_args))
		{
			$_args['get_token'] = false;
		}

		return self::token($_args);
	}


	public static function api($_args)
	{
		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args['get_token'] = true;
		$_args['api_mode']  = true;

		return self::token($_args);
	}


	public static function token($_args, $_return = false)
	{
		$default =
			[
				'amount'          => 0,
				'bank'            => null,
				'title'           => null,
				'type'            => null,
				'caller'          => null,
				'fromurl'         => null, // from url
				'turn_back'       => null, // back to this url
				'msg_go'          => null,
				'msg_back_ok'     => null,
				'msg_back_failed' => null,
				'auto_go'         => false,
				'auto_back'       => false,
				'final_fn'        => null,
				'factor_id'       => null,
				'final_fn_args'   => null,
				'final_msg'       => false,
				'user_id'         => null,
				'currency'        => null,
				'get_token'       => false,
				'api_mode'        => false,
				'pay_on_jibres'   => false,
			];

		if(!is_array($_args))
		{
			$_args = [];
		}

		if(!\dash\engine\store::inStore())
		{
			$default['store_id'] = null;
		}

		$_args = array_merge($default, $_args);

		$user_id = $_args['user_id'];

		$user_is_login = $user_id;

		if(!$user_id || !is_numeric($user_id))
		{
			$user_is_login = null;
			// pay as undefined user in some project
		}

		$_args['amount'] = \dash\validate::price($_args['amount']);

		if(is_numeric($_args['amount']) && $_args['amount'] > 0 && $_args['amount'] == round($_args['amount'], 0))
		{
			// no problem to continue!
		}
		else
		{
			\dash\notif::error(T_("Invalid amount"));
			return self::endCompile($_args);
		}


		$ip_id = \dash\utility\ip::id();

		$agent_id = \dash\agent::get(true);

		$filter_date = date("Y-m-d H:i:s", (time() - (60 * 60)));


		if($user_is_login)
		{
			$count_awating_transaction_per_user =
				\dash\db\transactions\get::count_awating_transaction_per_user($user_is_login, $filter_date);

			if($count_awating_transaction_per_user > 30)
			{
				\dash\notif::error(T_("You have a lot of unpaid transactions, please try again in a few minutes."));

				\dash\waf\ip::isolateIP(1, 'transactions count per hour. user is login');

				return self::endCompile($_args);
			}
		}
		else
		{
			if(!$ip_id || !$agent_id)
			{
				\dash\notif::error(T_("Who are you?"));

				\dash\waf\ip::isolateIP(1, 'ip_id or agent id is null!');

				return false;
			}

			$count_transaction_per_ip = \dash\db\transactions\get::count_transaction_per_ip($ip_id, $filter_date);

			if($count_transaction_per_ip > 20)
			{
				\dash\notif::error(T_("You have a lot of unpaid transactions, please login or try again in a few minutes!"));

				\dash\waf\ip::isolateIP(1, 'transactions count per hour check by ip');

				return self::endCompile($_args);
			}
			else
			{
				$count_transaction_per_ip_agent =
					\dash\db\transactions\get::count_transaction_per_ip_agent($ip_id, $agent_id, $filter_date);

				if($count_transaction_per_ip_agent > 10)
				{
					\dash\notif::error(T_("You have a lot of unpaid transactions, please login or try again in a few minutes."));

					\dash\waf\ip::isolateIP(1, 'transactions count per hour check by ip and agent');

					return self::endCompile($_args);
				}
			}
		}

		return self::generate_token($_args, $_return);
	}


	private static function endCompile($_args = [])
	{
		if(isset($_args['get_token']) && $_args['get_token'])
		{
			\dash\code::jsonBoom(\dash\notif::get());
		}
		else
		{
			return false;
		}
	}


	private static function generate_token($_args, $_return)
	{
		$payment_response =
			[
				'fromurl'         => $_args['fromurl'],
				'caller'          => $_args['caller'],
				'turn_back'       => $_args['turn_back'],
				'msg_go'          => $_args['msg_go'],
				'factor_id'       => $_args['factor_id'],
				'msg_back_ok'     => $_args['msg_back_ok'],
				'msg_back_failed' => $_args['msg_back_failed'],
				'auto_back'       => $_args['auto_back'],
				'final_fn'        => $_args['final_fn'],
				'final_fn_args'   => $_args['final_fn_args'],
				'final_msg'       => $_args['final_msg'],
				'auto_go'         => $_args['auto_go'],
				'get_token'       => $_args['get_token'],
				'api_mode'        => $_args['api_mode'],
				'currency'        => $_args['currency'],
				'raw'             => $_args,
			];

		if(!\dash\engine\store::inStore())
		{
			$payment_response['store_id'] = $_args['store_id'];
		}

		$payment_response = json_encode($payment_response, JSON_UNESCAPED_UNICODE);

		$_args['amount'] = \dash\validate::price($_args['amount']);

		$insert_transaction =
			[
				'title'            => $_args['title'] ? $_args['title'] : T_("Pay whith :bank", ['bank' => T_(ucfirst(strval($_args['bank'])))]),
				'currency'         => $_args['currency'],
				'type'             => $_args['type'] ? $_args['type'] : 'money',
				'plus'             => $_args['amount'],
				'factor_id'        => $_args['factor_id'],
				'caller'           => $_args['caller'],
				'amount_request'   => $_args['amount'],
				'payment'          => \dash\str::mb_strtolower($_args['bank']),
				'user_id'          => $_args['user_id'],
				'payment_response' => $payment_response,
			];

		if(isset($_args['store_id']) && $_args['store_id'])
		{
			$insert_transaction['store_id'] = $_args['store_id'];
		}


		$token = json_encode($insert_transaction);
		$token .= (string) time();
		$token .= (string) rand();
		$token .= (string) rand();
		$token .= (string) rand();
		$token = md5($token);

		$insert_transaction['condition'] = 'request';
		$insert_transaction['token']     = $token;


		$result = \dash\utility\pay\transactions::start($insert_transaction);


		if(!$result)
		{
			return self::endCompile($_args);
		}

		if(isset($_args['pay_on_jibres']) && $_args['pay_on_jibres'])
		{
			$url = \dash\url::jibres_domain();
		}
		else
		{
			$url = \dash\url::kingdom() . '/';
		}

		$url .= 'pay/' . $token;


		if($_args['bank'])
		{
			$url .= '?dp=' . $_args['bank'];
		}


		if($_args['get_token'])
		{
			$detail =
				[
					'token' => $token,
					'url'   => $url,
				];

			if($_return)
			{
				return $token;
			}
			else
			{
				if($_args['api_mode'])
				{
					$detail =
						[
							'token'          => $token,
							'url'            => $url,
							'transaction_id' => \dash\coding::encode($result),
						];

					return $detail;
				}
				else
				{
					\dash\notif::result($detail);
					\dash\code::jsonBoom(\dash\notif::get());
				}
			}
		}
		else
		{
			if(isset($_args['auto_go']) && $_args['auto_go'])
			{
				return self::bank(['token' => $token, 'bank' => self::default_bank()]);
			}
			else
			{
				\dash\utility\pay\setting::before_redirect();
				\dash\redirect::to($url);
			}
		}

	}


	private static function default_bank()
	{
		return null;
	}

}

?>