<?php
namespace dash\utility;
require(core."utility/kavenegar_api.php");

/** Sms management class **/
class sms
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
		if(mb_strlen($message) > self::is_rtl($message, true))
		{
			// if($sms_header && $_options['header'])
			// {
			// 	$message = $sms_header. "\n". $_message;
			// }

			if(mb_strlen($message) > self::is_rtl($message, true))
			{
				$message = $_message;
			}

			if($sms_footer && $_options['footer'])
			{
				$message    .= "\n\n";
				$message    .= $sms_footer;
			}
		}
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
			'line'           => self::line(),
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

		$datesend = date("Y-m-d H:i:s");

		// send sms
		$myApiData = new \dash\utility\kavenegar_api(self::kavenegar_auth(), $_options['line']);
		$result    = $myApiData->send($mobile, $message, $_options['type'], $_options['date'], $_options['LocalMessageid']);

		$insert_kavenegar_log =
		[
			'mobile'       => $mobile,
			'mobiles'      => null,
			'message'      => $message,
			'line'         => $_options['line'],
			'response'     => json_encode($result, JSON_UNESCAPED_UNICODE),
			'send'         => json_encode($_options, JSON_UNESCAPED_UNICODE),
			'datesend'     => $datesend,
			'dateresponse' => date("Y-m-d H:i:s"),
		];

		self::save_history($insert_kavenegar_log);


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


	public static function save_history($_args)
	{
		if(!is_array($_args))
		{
			$_args = [];
		}

		$defalt =
		[
			'mode'         => null,
			'mobile'       => null,
			'mobiles'      => null,
			'message'      => null,
			'urlmd5'       => null,
			'url'          => null,
			'type'         => null,
			'user_id'      => null,
			'store_id'     => null,
			'ip'           => null,
			'ip_id'        => null,
			'ip_md5'       => null,
			'agent_id'     => null,
			'line'         => null,
			'apikey'       => null,
			'response'     => null,
			'send'         => null,
			'datecreated'  => null,
			'datesend'     => null,
			'dateresponse' => null,
		];

		$_args = array_merge($defalt, $_args);

		$myIp   = \dash\server::ip();
		$ip_md5 = md5($myIp);
		$ip_id  = \dash\utility\ip::id($myIp);
		$type   = \dash\temp::get('kavenegar_sms_type'); //enum('signup', 'login','twostep', 'recovermobile', 'callback_signup', 'notif', 'other') NULL,

		if(!$_args['mode'])
		{
			$_args['mode'] = 'sms';
		}

		$_args['urlmd5']      = md5(\dash\url::pwd());
		$_args['url']         = \dash\url::pwd();
		$_args['type']        = $type; //  enum('signup', 'login','twostep', 'recovermobile', 'callback_signup', 'notif', 'other') NULL;
		$_args['user_id']     = \dash\user::id();
		$_args['store_id']    = \lib\store::id();
		$_args['ip']          = $myIp;
		$_args['ip_id']       = $ip_id;
		$_args['ip_md5']      = $ip_md5;
		$_args['agent_id']    = \dash\agent::get(true);
		$_args['apikey']      = self::kavenegar_auth();
		$_args['datecreated'] = date("Y-m-d H:i:s");

		\lib\db\kavenegar\insert::new_record($_args);

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
			'line'   => self::line(),
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

		$datesend = date("Y-m-d H:i:s");

		$result    = [];
		$message   = self::make_message($_message, $_options);
		$myApiData = new \dash\utility\kavenegar_api(self::kavenegar_auth(), $_options['line']);
		\dash\log::set('smsSendArray', ['count_send' => count($accepted_mobile)]);
		$chunk   = array_chunk($accepted_mobile, 200);
		foreach ($chunk as $key => $last_200_mobile)
		{
			$result[] = $myApiData->sendarray($_options['line'], $last_200_mobile, $message, $_options['type'], $_options['date']);
		}

		$insert_kavenegar_log =
		[
			'mobile'       => null,
			'mobiles'      => json_decode($accepted_mobile),
			'message'      => $message,
			'line'         => $_options['line'],
			'response'     => json_encode($result, JSON_UNESCAPED_UNICODE),
			'send'         => json_encode($_options, JSON_UNESCAPED_UNICODE),
			'datesend'     => $datesend,
			'dateresponse' => date("Y-m-d H:i:s"),
		];

		self::save_history($insert_kavenegar_log);


		return $result;
	}


	public static function info()
	{
		$myApiData = new \dash\utility\kavenegar_api(self::kavenegar_auth());
		$result    = $myApiData->account_info();
		return $result;
	}
}
?>