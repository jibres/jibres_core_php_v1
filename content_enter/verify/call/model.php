<?php
namespace content_enter\verify\call;


class model
{

	public static function post()
	{
		\dash\utility\enter::check_code('call');
	}


	public static function send_call_code()
	{
		\dash\utility\enter::generate_verification_code();

		$code = \dash\utility\enter::get_session('verification_code');

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
		elseif(\dash\user::detail('mobile'))
		{
			$my_mobile = \dash\user::detail('mobile');
		}

		if(!$my_mobile)
		{
			return false;
		}


		// ready to save log
		$log_meta =
		[
			'data' => $code,
			'meta' =>
			[

			]
		];



		if(\dash\url::isLocal())
		{
			$kavenegar_send_result = true;
		}
		else
		{
			\dash\log::set('call');

			if(\dash\language::current() === 'fa')
			{
				$code_split = str_split($code);
				$code_split = implode('،', $code_split);
				$message = "درود. کدِ فعالسازی شما $code_split. با جیبْرِسْ، بِفْروش و لِذّت بِبَر";
			}
			else
			{
				$message = "Your verification code is $code";

			}

			$kavenegar_send_result = \dash\utility\call::send_tts($my_mobile, $message, $code);
		}

		if($kavenegar_send_result === 411 && substr($my_mobile, 0, 2) === '98')
		{
			// invalid user mobil
			\dash\db\logs::set('kavenegar:service:411:call', \dash\utility\enter::user_data('id'), $log_meta);
			return false;
		}
		elseif($kavenegar_send_result === false)
		{
			\dash\db\logs::set('kavenegar:service:down:call', \dash\utility\enter::user_data('id'), $log_meta);
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

			\dash\db\logs::set('enter:send:call:result', \dash\utility\enter::user_data('id'), $log_meta);

			return true;
		}
		else
		{
			\dash\db\logs::set('enter:send:cannot:send:call', \dash\utility\enter::user_data('id'), $log_meta);
		}

		// why?!
		return false;
	}
}
?>
