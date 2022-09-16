<?php
namespace lib\app\sms;


/** Sms management class **/
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
	 * Makes a message.
	 *
	 * @param <type> $_message The message
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function make_message($_message, $_options = [])
	{
		$default_option =
			[
				'header' => true,
				'footer' => true,
			];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_option, $_options);

		$_message = trim($_message);

		// create complete message
		$sms_header = "";
		$sms_footer = "";

		if(!\dash\engine\store::inStore())
		{
			$sms_header = T_('Jibres') . ' | ' . T_('Sell and Enjoy');
			if(\dash\url::tld() === 'ir')
			{
				$sms_footer .= T_('Jibres.ir');
			}
			else
			{
				$sms_footer .= T_('Jibres.com');
			}
		}

		$message = '';

		if($sms_header && $_options['header'])
		{
			$message .= $sms_header;
			$message .= "\n";
		}

		$message .= $_message;

		if($sms_footer && $_options['footer'])
		{
			$message .= "\n";
			$message .= $sms_footer;
		}

		// try to change big message into one message
		// it must be optional
		// fix it later
		if(mb_strlen($message) > self::lengthOfOneSMSBaseOnContent($message))
		{
			// if($sms_header && $_options['header'])
			// {
			// 	$message = $sms_header. "\n". $_message;
			// }

			if(mb_strlen($message) > self::lengthOfOneSMSBaseOnContent($message))
			{
				$message = $_message;
			}

			if($sms_footer && $_options['footer'])
			{
				$message .= "\n";
				$message .= $sms_footer;
			}
		}
		return $message;
	}


	/**
	 * send sms
	 *
	 * @param <type> $_mobile  The mobile
	 * @param <type> $_message The message
	 * @param array  $_options The options
	 *
	 * @return     \|boolean  ( description_of_the_return_value )
	 */
	public static function send($_mobile, $_message, $_options = [], $_log_id = null, $_business_mode = false)
	{
		if(!$_mobile || !$_message || !trim($_message))
		{
			return null;
		}

		$default_option =
			[
				'line'           => self::line($_business_mode),
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
		$myApiData = new \dash\utility\kavenegar_api(self::kavenegar_auth($_business_mode), $_options['line']);
		$result    =
			$myApiData->send($mobile, $message, $_options['type'], $_options['date'], $_options['LocalMessageid']);

		$insert_kavenegar_log =
			[
				'mobile'       => $mobile,
				'message'      => $message,
				'line'         => $_options['line'],
				'response'     => json_encode($result, JSON_UNESCAPED_UNICODE),
				'send'         => json_encode($_options, JSON_UNESCAPED_UNICODE),
				'datesend'     => $datesend,
				'dateresponse' => date("Y-m-d H:i:s"),
				'apikey'       => self::kavenegar_auth(),
			];

		if($_log_id)
		{
			\lib\app\sms\history::update($insert_kavenegar_log, $_log_id);
		}
		else
		{
			\lib\app\sms\history::add($insert_kavenegar_log);
		}


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


	public static function verification_code($_mobile, $_template, $_token, $_token2 = null, $_token3 = null, $_token10 = null, $_token20 = null, $_type = null, $_log_id = null, $_business_mode = false)
	{
		if(!$_mobile || !$_token || !$_template)
		{
			return null;
		}

		$default_option =
			[
				'line' => self::line($_business_mode),
			];

		$_options = [];

		$_options = array_merge($default_option, $_options);


		$mobile = \dash\validate::ir_mobile($_mobile, false);
		if(!$mobile)
		{
			return false;
		}

		$datesend = date("Y-m-d H:i:s");

		// send sms
		$myApiData = new \dash\utility\kavenegar_api(self::kavenegar_auth($_business_mode), $_options['line']);
		$result    = $myApiData->verify($mobile, $_token, $_token2, $_token3, $_token10, $_token20, $_template, $_type);

		$insert_kavenegar_log =
			[
				'mobile'       => $mobile,
				'line'         => $_options['line'],
				'datesend'     => $datesend,
				'dateresponse' => date("Y-m-d H:i:s"),
				'apikey'       => self::kavenegar_auth($_business_mode),
			];

		if($_log_id)
		{
			\lib\app\sms\history::update($insert_kavenegar_log, $_log_id);
		}
		else
		{
			\lib\app\sms\history::add($insert_kavenegar_log);
		}

		return $result;
	}


	public static function calculateSMSCount($_message)
	{
		// fa : 70,  64,  67,  67,  ...
		$fa = [70, 64, 67];

		// en : 160, 146, 153, 153, ...
		$en = [160, 146, 153];

		$len       = mb_strlen($_message);
		$isRtl     = \dash\validate::is_rtl($_message);
		$countSMS  = 0;

		$checkArgs = $isRtl ? $fa : $en;

		if($len <= array_sum($checkArgs))
		{
			$lenCounterPlus = 0;

			foreach ($checkArgs as $stepLen)
			{
				$countSMS++;
				$lenCounterPlus += $stepLen;

				if($len <= $lenCounterPlus)
				{
					break;
				}
			}
		}
		else
		{
			$overflow       = $len - array_sum($checkArgs);
			$end            = end($checkArgs);
			$overflow_count = ceil($overflow / $end);
			$countSMS       = $overflow_count + count($checkArgs); // 3 sms for first 3 value in $checkArgs

		}

		return $countSMS;

	}


	/**
	 * check the input is rtl or not
	 *
	 * @param  [type]  $string [description]
	 * @param  [type]  $type   [description]
	 *
	 * @return boolean         [description]
	 */
	public static function lengthOfOneSMSBaseOnContent($_str)
	{
		$isRtl = \dash\validate::is_rtl($_str);


		$result = $isRtl ? 70 : 160;

		return $result;
	}


	/**
	 * Sends an array.
	 * send one message to multi mobile
	 *
	 * @param <type> $_mobiles The mobiles
	 * @param <type> $_message The message
	 * @param array  $_options The options
	 *
	 * @return     \|boolean  ( description_of_the_return_value )
	 */
	public static function send_array($_mobiles, $_message, $_options = [], $_log_id = null)
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
		$chunk = array_chunk($accepted_mobile, 200);
		foreach ($chunk as $key => $last_200_mobile)
		{
			$result[] =
				$myApiData->sendarray($_options['line'], $last_200_mobile, $message, $_options['type'], $_options['date']);
		}

		$insert_kavenegar_log =
			[
				'mobile'       => null,
				'message'      => $message,
				'line'         => $_options['line'],
				'response'     => json_encode($result, JSON_UNESCAPED_UNICODE),
				'send'         => json_encode($_options, JSON_UNESCAPED_UNICODE),
				'datesend'     => $datesend,
				'dateresponse' => date("Y-m-d H:i:s"),
				'apikey'       => self::kavenegar_auth(),
			];

		if($_log_id)
		{
			\lib\app\sms\history::update($insert_kavenegar_log, $_log_id);
		}
		else
		{
			\lib\app\sms\history::add($insert_kavenegar_log);
		}


		return $result;
	}


	public static function info()
	{
		$myApiData = new \dash\utility\kavenegar_api(self::kavenegar_auth());
		$result    = $myApiData->account_info();
		return $result;
	}


	public static function notSended()
	{
		$notSend = \lib\db\sms_log\get::not_sended(200);

		if(!is_array($notSend))
		{
			$notSend = [];
		}

		if(!$notSend)
		{
			return null;
		}

		$sending_queue =
			[
				'telegram' => [],
				'sms'      => [],
				'email'    => [],
			];

		foreach ($notSend as $key => $value)
		{
			if(isset($value['mobile']) && isset($value['message']))
			{
				$resendArgs =
					[
						'mobile'  => $value['mobile'],
						'message' => $value['message'],

					];

				$result = \lib\app\sms\queue::add_one($resendArgs, ['return_args_without_insert' => true]);

				$result['id']                            = $value['id'];
				$result['store_smslog_id']               = $value['id'];
				$sending_queue['sms'][$key]['sms_param'] = $result;

			}
		}

		if(!empty($sending_queue['sms']))
		{
			$finalResult = \lib\api\jibres\api::send_multiple_notif($sending_queue);

			\dash\log::save_multiple_notif_result($finalResult);
		}

		\dash\notif::ok(T_(":val SMS was sended by cronjob", ['val' => \dash\fit::number(count($sending_queue['sms']))]));
		return true;
	}


}

