<?php
namespace dash;


class allow
{
	private static $html = false;

	private static $file = false;


	/**
	 * SET allow send html
	 */
	public static function html()
	{
		self::$html = true;
	}


	/**
	 * Check is allowed html
	 */
	public static function allowed_html()
	{
		return self::$html;
	}


	/**
	 * SET allow upload file
	 */
	public static function file()
	{
		self::$file = true;
	}


	/**
	 * Return is allowed file
	 */
	public static function allowed_file()
	{
		return self::$file;
	}



	public static function check_allow_html()
	{
		// ok allowd html
		if(self::allowed_html())
		{
			return true;
		}

		if(\dash\request::request('html'))
		{
			// ip block
			\dash\header::status(403, T_("Can not send html on this page"));
			return false;
		}

		return true;
	}
}
?>