<?php
namespace dash;


class allow
{
	private static $html = false;

	private static $file = false;


	/**
	 * SET allow send html
	 */
	public static function html(bool $_allow = true)
	{
		self::$html = $_allow;
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
	public static function file(bool $_allow = true)
	{
		self::$file = $_allow;
	}


	/**
	 * Return is allowed file
	 */
	public static function allowed_file()
	{
		return self::$file;
	}


	/**
	 * Check is allowd html
	 * call in mvc controler
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function check_allow_html()
	{
		// ok allowd html
		if(self::allowed_html())
		{
			return true;
		}

		if(\dash\request::request('html'))
		{
			// isolate block
			\dash\waf\ip::isolateIP(1, 'send html in not allowd page');

			\dash\header::status(403, T_("Can not send html on this page"));
			return false;
		}

		return true;
	}


	/**
	 * Check is allowd file
	 * call in mvc controller
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function check_allow_file()
	{
		$files = \dash\request::files();

		// ok allowd file
		if(self::allowed_file())
		{
			if(is_array($files))
			{
				foreach ($files as $key => $value)
				{
					$allowed_file_upload_name =
					[
						'gallery',
						'gallery1',
						'logo',
						'file',
						'image',
						'avatar',
						'thumb',
						'file1',
						'file2',
						'upload',
						'cover',
						'nationalpic',
						'shpic',
					];

					if(in_array($key, $allowed_file_upload_name) || preg_match("/^a\_\d+$/", $key))
					{
						// ok
					}
					else
					{
						// isolate block
						\dash\waf\ip::isolateIP(1, 'invalid upload name in allowd page!');

						\dash\header::status(403, T_("Invalid upload name!"));
						return false;
					}
				}
			}
			return true;
		}

		if($files)
		{
			// isolate block
			\dash\waf\ip::isolateIP(1, 'send file in not allowd page');

			\dash\header::status(403, T_("Can not send file on this page"));
			return false;
		}

		return true;
	}
}
?>