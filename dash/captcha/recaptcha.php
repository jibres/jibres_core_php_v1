<?php
namespace dash\captcha;

/**
 * This class describes google recaptcha.
 */
class recaptcha
{

	private static function isEnable() : bool
	{
		if(\dash\url::isLocal())
		{
			// return false;
		}

		return true;

		// return false; // if have problem in load google services
	}

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
		if(!self::isEnable())
		{
			return null;
		}

		return \dash\setting\recaptcha::secret_v3();
	}


	/**
	 * Get secret v2
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function secret_v2()
	{
		if(!self::isEnable())
		{
			return null;
		}

		return \dash\setting\recaptcha::secret_v2();
	}


	/**
	 * Get sitekey v2
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function sitekey_v2()
	{
		if(!self::isEnable())
		{
			return null;
		}

		return \dash\setting\recaptcha::sitekey_v2();
	}


	/**
	 * Get sitekey v3
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function sitekey_v3()
	{
		if(!self::isEnable())
		{
			return null;
		}

		return \dash\setting\recaptcha::sitekey_v3();
	}


	/**
	 * Guard need to check recaptcha sitekey
	 */
	public static function sitekey()
	{
		if(!self::isEnable())
		{
			return null;
		}

		$v3 = self::sitekey_v3();
		if($v3)
		{
			return $v3;
		}

		$v2 = self::sitekey_v2();
		if($v2)
		{
			return $v2;
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
		if(!self::isEnable())
		{
			return null;
		}

		$request = \dash\request::is();
		$request = \dash\str::mb_strtolower($request);

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
		if(!self::isEnable())
		{
			return true;
		}

		$recaptcha_token   = \dash\request::post('recaptcha_token');
		$recaptcha_sitekey = \dash\request::post('recaptcha_sitekey');
		$recaptcha_action  = \dash\request::post('recaptcha_action');

		// validate string and len
		$recaptcha_action  = \dash\validate::string_50($recaptcha_action);
		$recaptcha_sitekey = \dash\validate::string_200($recaptcha_sitekey);
		$recaptcha_token   = \dash\validate::string_1000($recaptcha_token);

		if(!$recaptcha_token)
		{
			$errorMsg = T_("Error get google recaptcha detail! Please wait until google recaptcha is loaded");
			if(\dash\request::ajax())
			{
				\dash\header::status(401, $errorMsg);
			}
			else
			{
				\dash\notif::error($errorMsg);
				\dash\redirect::pwd();
			}
			return false;
		}

		if(!$recaptcha_sitekey)
		{
			\dash\header::status(400, T_("Error get google recaptcha detail!"));
			return false;
		}

		if(!$recaptcha_action)
		{
			\dash\header::status(400, T_("Error get google recaptcha detail!"));
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
		if($get_result === 'NotInternetConnection')
		{
			return true;
		}

		$success    = a($get_result, 'success');
		$score      = a($get_result, 'score');

		$hostname   = a($get_result, 'hostname');
		$action     = a($get_result, 'action');

		$reason = 'in-action:'. $recaptcha_action. '-|score:'. (string) floatval($score);

		$ok = true;

		if($success)
		{
			@header('x-rec-score: '. $score);

			// if in business host needless to verify host name
			if(!\dash\engine\store::inBusinessDomain())
			{
				if(\dash\url::host() !== $hostname)
				{
					$ok = false;
					$reason .= '|invalid-hostname:'. $hostname. '|current-hostname:'. \dash\url::host();
				}
			}

			if($recaptcha_action !== $action)
			{
				$ok = false;
				$reason .= '|invalid-action:'. $action. '|current-action:'. $recaptcha_action;
			}
		}
		else
		{
			$ok = false;
			$reason .= '|request-not-success!';
		}

		if($ok)
		{
			// if score is 0 maybe is human !!
			if(floatval($score) === floatval(0))
			{
				return true;
			}

			if(floatval($score) >= 0.5)
			{
				return true;
			}
		}


		\dash\waf\ip::isolateIP(1, $reason);

		return false;
	}


	public static function verify_v2($_token)
	{
		if(!self::isEnable())
		{
			return true;
		}

		$secret     = self::secret_v2();

		$myIp       = \dash\server::ip();

		$get_result = \dash\captcha\recaptcha_curl::verify($secret, $_token, $myIp);
		if($get_result === 'NotInternetConnection')
		{
			return true;
		}

		$success  = a($get_result, 'success');
		$hostname = a($get_result, 'hostname');

		if($success)
		{
			// if in business domain needless to verify host name
			// if(!\dash\engine\store::inBusinessDomain())
			// {
			// 	if(\dash\url::domain() !== $hostname)
			// 	{
			// 		return false;
			// 	}
			// }
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
		if(!self::isEnable())
		{
			return '';
		}

		$result = '';
		$result .= '<div class="hide">';
		$result .= '<input type="hidden" name="recaptcha_sitekey" value="'. self::sitekey_v3(). '" data-unclear>';
		$result .= '<input type="hidden" name="recaptcha_action" value="'. self::action(). '" data-unclear>';
		$result .= '<input type="hidden" name="recaptcha_token" value="" data-unclear>';
		$result .= '</div>';

		return $result;
	}
}
?>