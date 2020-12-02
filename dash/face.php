<?php
namespace dash;

class face
{
	private static $data = [];

	/**
	 * set and get values of html head
	 * @param  [type] $_variable [description]
	 * @param  [type] $_value    [description]
	 * @return [type]            [description]
	 */
	public static function __callStatic($_variable, $_value)
	{
		// if value is send, set it
		if(array_key_exists(0, $_value))
		{
			self::$data[$_variable] = $_value[0];
		}

		// return value
		if(isset(self::$data[$_variable]))
		{
			return self::$data[$_variable];
		}
		// if key is not set return null
		return null;
	}


	public static function siteTitle()
	{
		return "Jibres";
	}


	public static function hereTitle()
	{
		if(\dash\engine\store::inStore())
		{
			return \lib\store::title();
		}

		return T_(self::siteTitle());
	}


	public static function hereDesc()
	{
		if(\dash\engine\store::inStore())
		{
			if(\lib\store::desc())
			{
				return \lib\store::desc();
			}
			else
			{
				return T_("If you're planning to build an online store, Jibres is ready for you. Start for Free.");
			}
		}

		return T_(self::siteDesc());
	}


	public static function hereIcon()
	{
		if(\dash\engine\store::inStore())
		{
			return \lib\store::logo();
		}

		return \dash\url::icon();
	}


	public static function siteDesc()
	{
		return "Jibres is not just an online accounting software; We try to create the best financial platform that has everything you need to sale and manage your financial life.";
	}


	public static function siteSlogan()
	{
		return "Sell & Enjoy";
	}
}
?>