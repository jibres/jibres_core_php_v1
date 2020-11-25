<?php
namespace dash\utility;
require_once(core."utility/kavenegar_api.php");

/** call management class **/
class call
{
	private static function kavenegar_auth()
	{
		return \dash\setting\kavenegar::apikey();
	}

	private static function line()
	{
		return \dash\setting\kavenegar::line();
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
	public static function send($_mobile, $_template, $_token, $_options = [])
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
		$api    = new \dash\utility\kavenegar_api(self::kavenegar_auth(), $_options['line']);
		$result = $api->verify($mobile, $_token, $_options['token2'], $_options['token3'], $_template, $_options['type']);
		return $result;
	}


	public static function send_tts($_mobile, $_message)
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


		$datesend = date("Y-m-d H:i:s");

		// function verify($_mobile, $_token, $_token2 = null, $_token3 = null, $_text = null, $_type = 'sms')
		$api    = new \dash\utility\kavenegar_api(self::kavenegar_auth(), self::line());
		$result = $api->tts($mobile, $_message);

		$insert_kavenegar_log =
		[
			'mode'         => 'tts',
			'mobile'       => $mobile,
			'mobiles'      => null,
			'message'      => $_message,
			'line'         => self::line(),
			'datesend'     => $datesend,
			'dateresponse' => date("Y-m-d H:i:s"),
		];

		\dash\utility\sms::save_history($insert_kavenegar_log);

		return $result;
	}
}
?>