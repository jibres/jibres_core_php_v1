<?php
namespace lib\app\call;


/** call management class **/
class send
{
	private static function kavenegar_auth($_business_mode = false)
	{
		return \dash\setting\kavenegar::apikey($_business_mode);
	}

	private static function line($_business_mode = false)
	{
		return \dash\setting\kavenegar::line($_business_mode);
	}

	/**
	 * call mobile
	 *
	 * @param      <type>     $_mobile    The mobile
	 * @param      <type>     $_template  The template
	 * @param      <type>     $_token     The token
	 * @param      array      $_options   The options
	 *
	 * @return     \|boolean  ( description_of_the_return_value )
	 */
	public static function send($_mobile, $_template, $_token, $_options = [], $_business_mode = false)
	{
		if(!$_mobile || !$_template || !isset($_token))
		{
			return null;
		}

		$default_option =
		[
			'line'   => self::line(),
			'token2' => null,
			'token3' => null,
			'type'   => 'call',
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_option, $_options);

		$mobile = \dash\validate::ir_mobile($_mobile, false);
		if(!$mobile)
		{
			return false;
		}

		// function verify($_mobile, $_token, $_token2 = null, $_token3 = null, $_template = null, $_type = 'sms')
		$api    = new \dash\utility\kavenegar_api(self::kavenegar_auth($_business_mode), $_options['line']);
		$result = $api->verify($mobile, $_token, $_options['token2'], $_options['token3'], $_template, $_options['type']);
		return $result;
	}


	public static function send_tts($_mobile, $_message, $_business_mode = false)
	{
		if(!$_mobile || !$_message)
		{
			return null;
		}

		$mobile = \dash\validate::ir_mobile($_mobile, false);
		if(!$mobile)
		{
			return false;
		}

		// $add_sms =
		// [
		// 	'mobile'  => $_mobile,
		// 	'message' => $_message,
		// 	'mode'    => 'tts',
		// 	'type'    => 'login',
		// 	'sender'  => 'customer',
		// ];

		// $add_sms_result = \lib\app\sms\queue::add_one($add_sms);


		$datesend = date("Y-m-d H:i:s");

		// function verify($_mobile, $_token, $_token2 = null, $_token3 = null, $_text = null, $_type = 'sms')
		$api    = new \dash\utility\kavenegar_api(self::kavenegar_auth($_business_mode), self::line($_business_mode));
		$result = $api->tts($mobile, $_message);

		$insert_kavenegar_log =
		[
			'mode'         => 'tts',
			'mobile'       => $mobile,
			'message'      => $_message,
			'line'         => self::line(),
			'datesend'     => $datesend,
			'dateresponse' => date("Y-m-d H:i:s"),
		];

		\lib\app\sms\history::add($insert_kavenegar_log);

		return $result;
	}
}
?>