<?php
namespace dash\utility;


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


	private static function sitekey()
	{
		return 'site-key';
	}


	private static function category()
	{
		return 'the-category';
	}


	public static function html()
	{
		$result = '';
		$result .= '<div class="hide">';
		$result .= '<input type="hidden" name="recaptchasitekey" value="'. self::sitekey(). '">';
		$result .= '<input type="hidden" name="recaptchacat" value="'. self::category(). '">';
		$result .= '<input type="hidden" name="recaptchatoken" value="">';
		$result .= '</div>';

		return $result;
	}
}
?>