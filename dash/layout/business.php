<?php
namespace dash\layout;


class business
{

	/**
	 * Have website setting
	 *
	 * @var        bool
	 */
	private static $pagebuilder = false;


	/**
	 * The website settting
	 *
	 * @var        array
	 */
	private static $pagebuilder_setting = [];


	/**
	 * Temp variable to find is pagebuilder or old website setting
	 *
	 * @var        bool
	 */
	private static $have_header    = false;


	/**
	 * Have footer
	 *
	 * @var        bool
	 */
	private static $have_footer    = false;



	/**
	 * return the website is loaded or no
	 *
	 * @return     <type>  ( True | false )
	 */
	public static function website()
	{
		return self::$pagebuilder;
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

		if(!\dash\engine\content::is('content_business'))
		{
			return false;
		}

		// only check in businessWebsite
		if(!\dash\engine\store::inBusinessWebsite())
		{
			return false;
		}

		// store not found!
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
			self::$pagebuilder         = true;
			self::$pagebuilder_setting = $pagebuilder;

			\dash\data::website($pagebuilder);

			return true;
		}
		else
		{
			return false;
		}
	}



	public static function body_addr()
	{
		if(!self::$pagebuilder)
		{
			return null;
		}

		if(self::$pagebuilder)
		{
			return root. 'lib/pagebuilder/load/body.php';
		}
		elseif(\dash\engine\template::$finded_template)
		{
			return \dash\engine\template::$display_addr;
		}
		else
		{
			return null;
		}
	}
}
?>