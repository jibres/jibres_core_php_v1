<?php
namespace dash\layout;


class business
{
	/**
	 * Need remoce after conver all business website
	 *
	 * @var        bool
	 */
	private static $website = false;
	private static $website_setting = [];


	/**
	 * lock on page builder
	 *
	 * @var        bool
	 */
	private static $find_pagebuilder = false;

	private static $pagebuilder_setting = [];


	/**
	 * return the website is loaded or no
	 *
	 * @return     <type>  ( True | false )
	 */
	public static function website()
	{
		if(self::$find_pagebuilder)
		{
			return self::$find_pagebuilder;
		}

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



		// load page builder by detect current page
		$pagebuilder = \lib\pagebuilder\load\page::current_page();

		if($pagebuilder)
		{
			self::$find_pagebuilder    = true;
			self::$pagebuilder_setting = $pagebuilder;
			\dash\data::website($pagebuilder_setting);
			return true;
		}
		else
		{
			// after convert all business website to new version uncomment this line
			// return false;
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



	public static function body_addr()
	{
		if(self::$find_pagebuilder)
		{
			// nothing
		}
		else
		{
			if(!self::$website)
			{
				return null;
			}
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
			return \dash\engine\template::$display_addr;
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