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

		$load_website_setting = \lib\app\website\generator::load_website_setting();

		if(!$load_website_setting)
		{
			return false;
		}

		if(isset($load_website_setting['template']))
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

		\dash\data::website($load_website_setting);

		return true;
	}


	public static function header_addr()
	{
		if(isset(self::$website_setting['header']['active']))
		{
			$header_name = self::$website_setting['header']['active'];
			$addr = self::template_addr(). 'header.php';
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
			$addr = self::template_addr(). 'footer.php';
			if(is_file($addr))
			{
				return $addr;
			}

		}
	}


	public static function body_addr()
	{
		if(!self::$website)
		{
			return null;
		}

		if(\dash\engine\content::get() !== 'content_business')
		{
			return null;
		}

		// check only in home module
		// this variable set on content business home controller
		if(!\dash\temp::get('inHomePageOfBusiness'))
		{
			return null;
		}

		// load a post by display of content_n
		if(\dash\engine\template::$finded_template)
		{
			// load the business post
			return root. 'content_n/home/display.php';
		}

		$addr = self::template_addr(). 'body.php';
		if(is_file($addr))
		{
			return $addr;
		}


	}


	private static function template_addr($_folder = null)
	{
		$addr = root. 'content_business/home/layout/';
		if($_folder)
		{
			$addr .= $_folder . '/';
		}

		return $addr;
	}

}
?>