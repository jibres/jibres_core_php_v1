<?php
namespace dash;


class language
{
	public static $language = [];
	public static $language_default = null;

	/**
	 * all language dash supported it
	 *
	 * @var        array
	 */
	public static $data =
	[
		'en' => ['name' => 'en', 'direction' => 'ltr', 'iso' => 'en_US', 'localname' => 'English'],
		'fa' => ['name' => 'fa', 'direction' => 'rtl', 'iso' => 'fa_IR', 'localname' => 'فارسی'],
		// 'ar' => ['name' => 'ar', 'direction' => 'rtl', 'iso' => 'ar_IQ', 'localname' => 'العربية'],
	];


	public static function primary()
	{
		// if(\dash\url::root() === 'jibres')
		{
			// for ir domain default lang is fa
			if(\dash\url::tld() === 'ir')
			{
				return 'fa';
			}

			return 'en';
		}
		// else
		// {
		// 	return 'fa';
		// }
	}


	/**
	 * get lost of languages
	 */
	public static function all($_for_html = false)
	{
		$list = [];

		foreach (self::$data as $key => $value)
		{
			if($_for_html)
			{
				if(isset(self::$data[$key]['localname']))
				{
					$list[$key] = self::$data[$key]['localname'];
				}
			}
			else
			{
				$list[$key] = self::$data[$key];
			}
		}

		return $list;
	}


	/**
	 * check language exist and return true or false
	 * @param  [type] $_lang   [description]
	 * @param  string $_column [description]
	 * @return [type]          [description]
	 */
	public static function check($_lang)
	{
		return array_key_exists($_lang, self::$data);
	}


	/**
	 * get lang
	 *
	 * @param      <type>  $_key      The key
	 * @param      string  $_request  The request
	 */
	public static function get($_key, $_request = 'iso')
	{
		$result = null;
		// if pass more than 2 character, then only use 2 char
		if(strlen($_key)> 2)
		{
			$_key = substr($_key, 0, 2);
		}

		$site_lang = self::all();

		if(!empty($site_lang) && isset($site_lang[$_key]))
		{
			if($_request === 'all' || !$_request)
			{
				$result = $site_lang[$_key];
			}
			else
			{
				$result = $site_lang[$_key][$_request];
			}
		}
		return $result;
	}

	public static function dir()
	{
		if(isset(self::$language['direction']))
		{
			return self::$language['direction'];
		}

		return 'ltr';
	}


	/**
	 * get detail of language
	 * @param  string $_request [description]
	 * @return [type]           [description]
	 */
	public static function current()
	{
		if(isset(self::$language['name']))
		{
			return self::$language['name'];
		}

		return null;
	}


	/**
	 * get detail of language
	 * @param  string $_request [description]
	 * @return [type]           [description]
	 */
	public static function currentAll($_request = 'name')
	{
		if(!self::$language)
		{
			self::detect_language();
		}

		$result = null;
		if($_request === 'all')
		{
			$result = self::$language;
		}
		elseif(isset(self::$language[$_request]))
		{
			$result = self::$language[$_request];
		}
		return $result;
	}


	/**
	 * set language of service
	 * @param [type] $_language [description]
	 */
	public static function set_language($_language)
	{
		// get all detail of this language
		self::$language = self::get($_language, 'all');

		if(!self::$language)
		{
			self::$language_default = self::primary();
			self::$language = self::get(self::$language_default, 'all');
		}

		// use php gettext function
		require_once(core.'engine/i18n/translator.php');
		// if we have iso then trans
		if(isset(self::$language['iso']))
		{
			// gettext setup
			T_setlocale(LC_MESSAGES, (self::$language['iso']));
			// Set the text domain as 'messages'
			T_bindtextdomain('messages', root.'includes/languages');
			T_bind_textdomain_codeset('messages', 'UTF-8');
			T_textdomain('messages');
		}
	}


	public static function detect_language()
	{
		if(self::$language)
		{
			return false;
		}

		$url_lang = \dash\url::lang();
		if($url_lang && array_key_exists($url_lang, self::$data))
		{
			self::set_language($url_lang);
		}
		else
		{
			self::set_language(self::primary());
		}
	}
}
?>