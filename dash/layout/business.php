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
	private static $have_header    = false;
	private static $have_footer    = false;



	/**
	 * return the website is loaded or no
	 *
	 * @return     <type>  ( True | false )
	 */
	public static function website()
	{
		return self::$website;
	}


	public static function is_pagebuilder()
	{
		return self::$is_pagebuilder;
	}



	public static function have_header()
	{
		return self::$have_header;
	}


	public static function have_footer()
	{
		return self::$have_footer;
	}



	/**
	 * Load business website
	 *
	 * @return     boolean  (if true not route default html and load business website)
	 */
	public static function check_website()
	{
		if(in_array(\dash\engine\content::get(), ['content_business', 'content_n']) && \dash\engine\store::inBusinessWebsite())
		{
			// need to check website
		}
		else
		{
			return false;
		}

		$store_id = \lib\store::id();

		if(!$store_id)
		{
			return false;
		}



		// load page builder by detect current page
		$pagebuilder = \lib\pagebuilder\load\page::current_page();

		if(isset($pagebuilder['post_detail']['ishomepage']) && $pagebuilder['post_detail']['ishomepage'])
		{
			self::$have_header = true;
			self::$have_footer = true;
		}
		else
		{
			// need to load homepage header and footer
			$homepage_header_footer = \lib\pagebuilder\load\page::homepage_header_footer();

			if(isset($homepage_header_footer['header']) && $homepage_header_footer['header'])
			{
				self::$have_header = true;
			}


			if(isset($homepage_header_footer['footer']) && $homepage_header_footer['footer'])
			{
				self::$have_footer = true;
			}

		}

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
			return false;
		}
	}



	public static function body_addr()
	{
		if(!self::$website)
		{
			return null;
		}

		if(!in_array(\dash\engine\content::get(), ['content_business', 'content_n']))
		{
			return null;
		}

		// check only in home module
		// this variable set on content business home controller
		if(!\dash\temp::get('NeedToCheckPageBuilderLoad'))
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