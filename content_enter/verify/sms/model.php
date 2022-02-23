<?php
namespace content_enter\verify\sms;


class model
{

	public static function post()
	{
		\dash\utility\enter::check_code('sms');
	}


	public static function send_sms_code()
	{
		$my_mobile = null;
		if(\dash\utility\enter::user_data('mobile'))
		{
			$my_mobile = \dash\utility\enter::user_data('mobile');
		}
		elseif(\dash\utility\enter::get_session('mobile'))
		{
			$my_mobile = \dash\utility\enter::get_session('mobile');
		}
		elseif(\dash\utility\enter::get_session('temp_mobile'))
		{
			$my_mobile = \dash\utility\enter::get_session('temp_mobile');
		}
		elseif(\dash\utility\enter::get_session('usernameormobile'))
		{
			$my_mobile = \dash\utility\enter::get_session('usernameormobile');
		}
		elseif(\dash\user::detail('mobile'))
		{
			$my_mobile = \dash\user::detail('mobile');
		}

		if(!$my_mobile)
		{
			\dash\log::set('enterVerifySMSmobileNotFoundInModel');
			return false;
		}

		\dash\utility\enter::generate_verification_code();


		$code = \dash\utility\enter::get_session('verification_code');

		$log_meta =
		[
			'data' => $code,
			'meta' =>
			[
				'mobile'  => $my_mobile,
				'code'    => $code,
			]
		];

		$sms_option = [];

		if(\dash\engine\store::inStore())
		{
			$msg = T_(":code is your verification code.", ['code' => "code ". $code]);
			$msg .= "\n". \dash\url::host();
			$sms_option['footer'] = false;
		}
		else
		{
			$msg = T_(":code is your Jibres verification code.", ['code' => "code ". $code]);
		}

		// $msg = "code ". $code;
		// $msg = "Use above code to verify your account";

		if(\dash\url::isLocal())
		{
			$kavenegar_send_result = true;
		}
		else
		{

			\dash\utility\enter::set_kavenegar_log_type();

			if(\dash\language::current() === 'fa')
			{
				$lang = 'fa';
			}
			else
			{
				$lang = 'en';
			}

			$business = null;
			if(\dash\engine\store::inStore())
			{
				$business = '-business';
			}

			$template = 'jibres'. $business. '-enter-'. $lang;

			$token    = $code;

			if(\dash\engine\store::inStore())
			{
				$sms_setting = \lib\app\setting\get::sms_setting();
				if(isset($sms_setting['kavenegar_apikey']) && $sms_setting['kavenegar_apikey'])
				{
					$add_sms =
					[
						'mobile'  => $my_mobile,
						'message' => $msg,
						'sender'  => 'customer',
						'mode'    => 'verification',
						'type'    => 'login',
					];

					$add_sms_result = \lib\app\sms\queue::add_one($add_sms);

					if($add_sms_result)
					{
						$kavenegar_send_result = true;
					}

					// need to remove it after send sms by queue
					$kavenegar_send_result = \lib\app\sms\send::send($my_mobile, $msg, $sms_option);
				}
				else
				{
					$token2 = \lib\store::title();

					$add_sms =
					[
						'mobile'   => $my_mobile,
						'template' => $template,
						'mode'     => 'verification',
						'type'     => 'login',
						'token'    => $token,
						'token2'   => $token2,
						'message'  => null,
						'sender'   => 'customer',
					];

					$add_sms_result = \lib\app\sms\queue::add_one($add_sms);

					if($add_sms_result)
					{
						$kavenegar_send_result = true;
					}


					$kavenegar_send_result = \lib\app\sms\send::verification_code($my_mobile, $template, $token, null, null, null, $token2);
				}
			}
			else
			{
				$add_sms =
				[
					'mobile'   => $my_mobile,
					'template' => $template,
					'mode'     => 'verification',
					'type'     => 'login',
					'token'    => $token,
					'message'  => null,
					'sender'   => 'customer',
				];

				$add_sms_result = \lib\app\sms\queue::add_one($add_sms);

				if($add_sms_result)
				{
					$kavenegar_send_result = true;
				}

				$kavenegar_send_result = \lib\app\sms\send::verification_code($my_mobile, $template, $token);
			}

		}

		if($kavenegar_send_result === 411 && substr($my_mobile, 0, 2) === '98')
		{
			// invalid user mobil
			\dash\db\logs::set('kavenegar:service:411:sms', \dash\utility\enter::user_data('id'), $log_meta);
			return false;
		}
		elseif($kavenegar_send_result === false)
		{
			\dash\db\logs::set('kavenegar:service:done:sms', \dash\utility\enter::user_data('id'), $log_meta);
			// the kavenegar service is down!!!
		}
		elseif($kavenegar_send_result)
		{

			$log_meta['meta']['response'] = [];

			if(is_string($kavenegar_send_result))
			{
				$log_meta['meta']['response'] = $kavenegar_send_result;
			}
			elseif(is_array($kavenegar_send_result))
			{
				foreach ($kavenegar_send_result as $key => $value)
				{
					$log_meta['meta']['response'][$key] = str_replace("\n", ' ', $value);
				}
			}

			\dash\db\logs::set('enter:send:sems:result', \dash\utility\enter::user_data('id'), $log_meta);

			return true;
		}
		else
		{
			\dash\db\logs::set('enter:send:cannot:send:sms', \dash\utility\enter::user_data('id'), $log_meta);
		}

		return false;
	}
}
?>
