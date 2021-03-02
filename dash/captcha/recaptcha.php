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
		if(!\dash\request::post('recaptchatoken'))
		{
			return false;
		}
		// check
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