<?php
namespace dash\utility;
require(core."utility/kavenegar_api.php");

/** Sms management class **/
class sms
{
	private static $kavenegar_auth = '5263694C4C426651434C6635686E463550333747363578636361446539383141';
	/**
	 * Makes a message.
	 *
	 * @param      <type>  $_message  The message
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function make_message($_message, $_options = [])
	{
		$default_option =
		[
			'header'         => true,
			'footer'         => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_option, $_options);

		$_message = trim($_message);

		// create complete message
		$sms_header = T_('Jibres') . ' | '. T_('Sell and Enjoy');
		$sms_footer = "";
		if(\dash\url::tld() === 'ir')
		{
			$sms_footer .= T_('Jibres.ir');
		}
		else
		{
			$sms_footer .= T_('Jibres.com');
		}

		$message = '';

		if($sms_header && $_options['header'])
		{
			$message    .= $sms_header;
			$message    .= "\n";
		}

		$message .= $_message;

		if($sms_footer && $_options['footer'])
		{
			$message    .= "\n\n";
			$message    .= $sms_footer;
		}

		// try to change big message into one message
		// it must be optional
		// fix it later
		// if(mb_strlen($message) > self::is_rtl($message, true))
		// {
		// 	if($sms_header && $_options['header'])
		// 	{
		// 		$message = $sms_header. "\n". $_message;
		// 	}

		// 	if(mb_strlen($message) > self::is_rtl($message, true))
		// 	{
		// 		$message = $_message;
		// 	}
		// }
		return $message;
	}

	/**
	 * send sms
	 *
	 * @param      <type>     $_mobile   The mobile
	 * @param      <type>     $_message  The message
	 * @param      array      $_options  The options
	 *
	 * @return     \|boolean  ( description_of_the_return_value )
	 */
	public static function send($_mobile, $_message, $_options = [])
	{
		if(!$_mobile || !$_message || !trim($_message))
		{
			return null;
		}

		$default_option =
		[
			'line'           => 100020009,
			'type'           => 1,
			'date'           => 0,
			'LocalMessageid' => null,
			'header'         => true,
			'footer'         => true,
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

		$message = self::make_message($_message, $_options);
		\dash\log::set('smsSend');

		// send sms
		$myApiData = new \dash\utility\kavenegar_api(self::$kavenegar_auth, $_options['line']);
		$result    = $myApiData->send($mobile, $message, $_options['type'], $_options['date'], $_options['LocalMessageid']);

		// success result
		// {
		// 	"messageid": 753233381,
		// 	"message": "sms text",
		// 	"status": 5,
		// 	"statustext": "ارسال به مخابرات",
		// 	"sender": "10006660066600",
		// 	"receptor": "09109610612",
		// 	"date": 1565518264,
		// 	"cost": 180
		// }
		return $result;

	}

	/**
	 * check the input is rtl or not
	 * @param  [type]  $string [description]
	 * @param  [type]  $type   [description]
	 * @return boolean         [description]
	 */
	private static function is_rtl($_str, $_type = false)
	{
		$rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
		$result            = preg_match($rtl_chars_pattern, $_str);
		if($_type)
		{
			$result = $result? 70: 160;
		}
		return $result;
	}


	/**
	 * Sends an array.
	 * send one message to multi mobile
	 *
	 * @param      <type>     $_mobiles  The mobiles
	 * @param      <type>     $_message  The message
	 * @param      array      $_options  The options
	 *
	 * @return     \|boolean  ( description_of_the_return_value )
	 */
	public static function send_array($_mobiles, $_message, $_options = [])
	{
		if(!$_mobiles || !$_message || !is_array($_mobiles))
		{
			return null;
		}

		$default_option =
		[
			'line'   => 100020009,
			'type'   => 1,
			'date'   => 0,
			'header' => true,
			'footer' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_option, $_options);

		$accepted_mobile = [];
		foreach ($_mobiles as $key => $value)
		{
			$mobile = \dash\validate::ir_mobile($value, false);

			if($mobile)
			{
				array_push($accepted_mobile, $value);
			}
		}

		$accepted_mobile = array_filter($accepted_mobile);
		$accepted_mobile = array_unique($accepted_mobile);

		if(empty($accepted_mobile))
		{
			return null;
		}

		$result    = [];
		$message   = self::make_message($_message, $_options);
		$myApiData = new \dash\utility\kavenegar_api(self::$kavenegar_auth, $_options['line']);
		\dash\log::set('smsSendArray', ['count_send' => count($accepted_mobile)]);
		$chunk   = array_chunk($accepted_mobile, 200);
		foreach ($chunk as $key => $last_200_mobile)
		{
			$result[] = $myApiData->sendarray($_options['line'], $last_200_mobile, $message, $_options['type'], $_options['date']);
		}

		return $result;
	}


	public static function info()
	{
		$myApiData = new \dash\utility\kavenegar_api(self::$kavenegar_auth);
		$result    = $myApiData->account_info();
		return $result;
	}
}
?>