<?php
namespace dash\captcha;


class recaptcha
{

	public static function set()
	{
		$request = \dash\request::is();
		$request = mb_strtolower($request);

		if($request === 'get')
		{
			// nothing
		}
		elseif($request === 'post')
		{
			if(!self::check())
			{
				\dash\header::status(400, T_("Are you robot?"));
			}
		}
		else
		{
			\dash\header::status(400, T_("You wander in a labyrinth!!!"));
		}
	}




	private static function check()
	{
		if(!\dash\request::post('recaptcha_token'))
		{
			return false;
		}

		$gRecaptchaResponse = \dash\request::post('recaptcha_token');

		$secret = self::secret();

		try
		{
			require_once core.'bin/recaptcha/src/autoload.php';

			$recaptcha = new \ReCaptcha\ReCaptcha($secret);

			$resp = $recaptcha->setExpectedAction(self::action())->verify($gRecaptchaResponse);

			if($resp->isSuccess())
			{
				@header('x-rec-score: '. $resp->getScore());
			    // Verified!
			    return true;
			}
			else
			{
			    $errors = $resp->getErrorCodes();
			    return false;
			}

		}
		catch (\Exception $e)
		{
			return false;
		}

		return false;
	}


	private static function secret()
	{
		return '6LeLI84ZAAAAAKv12zC_fDlc8WVZzKCSkSqZd3Py';
	}


	public static function sitekey()
	{
		$site_key = '6LeLI84ZAAAAAD6NG_MHThUO4pKUIxCQW8Xkcr3a';

		return $site_key;
	}


	private static function action()
	{
		return 'enter';
	}


	public static function html()
	{
		$result = '';
		$result .= '<div class="hide">';
		$result .= '<input type="hidden" name="recaptcha_sitekey" value="'. self::sitekey(). '">';
		$result .= '<input type="hidden" name="recaptcha_action" value="'. self::action(). '">';
		$result .= '<input type="hidden" name="recaptcha_token" value="">';
		$result .= '</div>';

		return $result;
	}
}
?>