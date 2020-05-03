<?php
namespace dash\layout;


class business
{

	private static $website = false;

	private static $website_setting = [];


	/**
	 * return the website is loaded or no
	 *
	 * @return     <type>  ( True | false )
	 */
	public static function website()
	{
		return self::$website;
	}


	/**
	 * Load business website
	 *
	 * @return     boolean  (if true not route default html and load business website)
	 */
	public static function check_website()
	{
		$store_id = \lib\store::id();

		if(!$store_id)
		{
			return false;
		}

		$load_website_setting = self::load_website_setting($store_id);

		if(!$load_website_setting)
		{
			return false;
		}

		if(isset($load_website_setting['template']) && $load_website_setting['template'] === 'publish')
		{
			// nothing
		}
		else
		{
			// site not published
			return false;
		}

		self::$website = true;

		self::$website_setting = $load_website_setting;

		return true;
	}


	public static function header_addr()
	{
		if(isset(self::$website_setting['header']['active']))
		{
			$header_name = self::$website_setting['header']['active'];
			$addr = self::template_addr('header'). $header_name. '.php';
			if(is_file($addr))
			{
				return $addr;
			}

		}
	}


	public static function footer_addr()
	{
		if(isset(self::$website_setting['footer']['active']))
		{
			$footer_name = self::$website_setting['footer']['active'];
			$addr = self::template_addr('footer'). $footer_name. '.php';
			if(is_file($addr))
			{
				return $addr;
			}

		}
	}


	public static function body_addr()
	{
		if(self::$website)
		{
			$addr = self::template_addr('body'). 'body_ganerator.php';
			if(is_file($addr))
			{
				return $addr;
			}

		}
	}


	private static function template_addr($_folder = null)
	{
		$addr = root. 'content_subdomain/home/layout/';
		if($_folder)
		{
			$addr .= $_folder . '/';
		}

		return $addr;
	}



	/**
	 * Loads a website setting from file and database
	 *
	 * @param      <type>         $_store_id  The store identifier
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function load_website_setting($_store_id)
	{
		$addr = \dash\engine\store::website_addr();

		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}

		$addr .= $_store_id;

		$website_setting = [];

		if(is_file($addr))
		{
			$load = \dash\file::read($addr);
			$load = json_decode($load, true);
			if(!is_array($load))
			{
				$load = [];
			}

			$website_setting = $load;
		}

		if(empty($website_setting))
		{
			$load_query = \lib\app\website\template::get();
			if(!is_array($load_query))
			{
				$load_query = [];
			}

			$load_query['update_time'] = time();

			$website_setting = $load_query;

			\dash\file::write($addr, json_encode($website_setting, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

		}

		if(isset($website_setting['template']))
		{
			return $website_setting;
		}

		return false;

	}
}
?>