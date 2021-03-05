<?php
namespace dash\captcha;

/**
 * This class describes google recaptcha.
 */
class recaptcha
{
	/**
	 * Default action
	 */
	private static $action = 'masteraction';

	/**
	 * { function_description }
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function action($_action = null)
	{
		if($_action === null)
		{
			return self::$action;
		}
		else
		{
			self::$action = $_action;
		}
	}


	/**
	 * Get secret key of v3
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function secret_v3()
	{
		return '6LeLI84ZAAAAAKv12zC_fDlc8WVZzKCSkSqZd3Py';
	}


	private static function secret_v2()
	{
		return '6Ldh0G8aAAAAAM5dwVsvw2OfW_05I3XZykq_CPLP';
	}


	/**
	 * Get sitekey
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function sitekey_v3()
	{
		$site_key = '6LeLI84ZAAAAAD6NG_MHThUO4pKUIxCQW8Xkcr3a';

		return $site_key;
	}


	/**
	 * Guard need to check recaptcha sitekey
	 */
	public static function sitekey()
	{
		$v3 = self::sitekey_v3();
		if($v3)
		{
			return $v3;
		}

		return false;
	}


	/**
	 * Set the recaptcha
	 *
	 * @param      <type>  $_action  The action
	 */
	public static function set($_action = null)
	{
		$request = \dash\request::is();
		$request = mb_strtolower($request);

		// set action
		self::action($_action);

		if($request === 'get')
		{
			// nothing
		}
		elseif($request === 'post')
		{
			if(!self::verify_v3())
			{
				\dash\header::status(400, T_("Are you robot?"));
			}
		}
		else
		{
			\dash\header::status(400, T_("You wander in a labyrinth!!!"));
		}
	}




	private static function verify_v3()
	{
		$recaptcha_token   = \dash\request::post('recaptcha_token');
		$recaptcha_sitekey = \dash\request::post('recaptcha_sitekey');
		$recaptcha_action  = \dash\request::post('recaptcha_action');

		// validate string and len
		$recaptcha_action  = \dash\validate::string_50($recaptcha_action);
		$recaptcha_sitekey = \dash\validate::string_200($recaptcha_sitekey);
		$recaptcha_token   = \dash\validate::string_1000($recaptcha_token);

		if(!$recaptcha_token)
		{
			\dash\header::status(400, T_("Need ReCaptcha token!"));
			return false;
		}

		if(!$recaptcha_sitekey)
		{
			\dash\header::status(400, T_("Need ReCaptcha sitekey!"));
			return false;
		}

		if(!$recaptcha_action)
		{
			\dash\header::status(400, T_("Need ReCaptcha action!"));
			return false;
		}


		if($recaptcha_sitekey !== self::sitekey_v3())
		{
			\dash\header::status(400, T_("What happend? ReCaptcha sitekey is invalid!"));
			return false;
		}

		if($recaptcha_action !== self::action())
		{
			\dash\header::status(400, T_("What happend? ReCaptcha action is invalid!"));
			return false;
		}

		$secret     = self::secret_v3();

		$myIp       = \dash\server::ip();

		$get_result = \dash\captcha\recaptcha_curl::verify($secret, $recaptcha_token, $myIp);

		$success    = a($get_result, 'success');
		$score      = a($get_result, 'score');

		if($success)
		{
			@header('x-rec-score: '. $score);

			if(floatval($score) >= 0.5)
			{
		    	return true;
			}
		}

		$reason = $recaptcha_action. '-'. (string) floatval($score);

		\dash\waf\ip::isolateIP(1, $reason);

		return false;
	}


	public static function verify_v2($_token)
	{
		$secret     = self::secret_v2();

		$myIp       = \dash\server::ip();

		$get_result = \dash\captcha\recaptcha_curl::verify($secret, $_token, $myIp);

		$success    = a($get_result, 'success');

		if($success)
		{
		    // Verified!
		    return true;
		}
		else
		{
		    return false;
		}

	}



	public static function html()
	{
		$result = '';
		$result .= '<div class="hide">';
		$result .= '<input type="hidden" name="recaptcha_sitekey" value="'. self::sitekey_v3(). '">';
		$result .= '<input type="hidden" name="recaptcha_action" value="'. self::action(). '">';
		$result .= '<input type="hidden" name="recaptcha_token" value="">';
		$result .= '</div>';

		return $result;
	}
}
?>