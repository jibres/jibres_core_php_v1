<?php
namespace dash\layout;


class business
{

	/**
	 * Have website setting
	 *
	 * @var        bool
	 */
	private static $website = false;


	/**
	 * The website settting
	 *
	 * @var        array
	 */
	private static $website_setting = [];


	/**
	 * Temp variable to find is pagebuilder or old website setting
	 *
	 * @var        bool
	 */
	private static $is_pagebuilder = false;


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


		if(\dash\url::isLocal())
		{
			// load page builder by detect current page
			$pagebuilder = \lib\pagebuilder\load\page::current_page();

			if($pagebuilder)
			{
				self::$is_pagebuilder  = true;
				self::$website         = true;
				self::$website_setting = $pagebuilder;

				\dash\data::website($pagebuilder);
				return true;
			}
			else
			{
				// after convert all business website to new version uncomment this line
				// return false;
			}
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


	public static function set_view_variable()
	{
		// set page title
		// cover
		// seo desc
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


		if(self::$is_pagebuilder)
		{
			return root. 'lib/pagebuilder/load/body.php';
		}
		elseif(\dash\engine\template::$finded_template)
		{
			return \dash\engine\template::$display_addr;
		}
		else
		{
			$addr = self::template_addr(). 'body.php';
			if(is_file($addr))
			{
				return $addr;
			}
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