<?php
namespace dash\utility;
require(core."utility/kavenegar_api.php");

/** call management class **/
class call
{
	private static $kavenegar_auth = '5263694C4C426651434C6635686E463550333747363578636361446539383141';


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
			'line'   => 100020009,
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
		$api    = new \dash\utility\kavenegar_api(self::$kavenegar_auth, $_options['line']);
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



		// function verify($_mobile, $_token, $_token2 = null, $_token3 = null, $_text = null, $_type = 'sms')
		$api    = new \dash\utility\kavenegar_api(self::$kavenegar_auth, 100020009);
		$result = $api->tts($mobile, $_message);
		return $result;
	}
}
?>