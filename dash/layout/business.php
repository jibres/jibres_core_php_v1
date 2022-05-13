<?php
namespace dash\layout;


class business
{

	/**
	 * Have website setting
	 *
	 * @var        bool
	 */
	private static $siteBuilder = false;


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
		return self::$siteBuilder;
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
		if(\dash\temp::get('ForceLoadSiteBuilderForJibres'))
		{
			// nothing
		}
		else
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

		}

		// store not found!
		$store_id = \lib\store::id();

		if(!$store_id)
		{
			return false;
		}


		// load page builder by detect current page
		$siteBuilder = \content_site\load\load::current_page();

		if(isset($siteBuilder['post_detail']['ishomepage']) && $siteBuilder['post_detail']['ishomepage'])
		{
			self::$have_header = true;
			self::$have_footer = true;
		}
		else
		{
			$homepage_header_footer = [];

			if(!a($siteBuilder, 'header') || !a($siteBuilder, 'footer'))
			{
				// need to load homepage header and footer
				$homepage_header_footer = \content_site\load\load::homepage_header_footer();
			}

			if(a($siteBuilder, 'header'))
			{
				self::$have_header = true;
			}
			elseif(isset($homepage_header_footer['header']) && $homepage_header_footer['header'])
			{
				self::$have_header = true;
			}

			if(a($siteBuilder, 'footer'))
			{
				self::$have_footer = true;
			}
			elseif(isset($homepage_header_footer['footer']) && $homepage_header_footer['footer'])
			{
				self::$have_footer = true;
			}
		}


		if($siteBuilder)
		{
			self::$siteBuilder = true;

			\dash\data::website($siteBuilder);

			return true;
		}

	}



	public static function body_addr()
	{
		if(!self::$siteBuilder)
		{
			return null;
		}

		if(self::$siteBuilder)
		{
			if(\dash\data::demoOnlineLoadPreviewSection())
			{
				return root. 'content_site/preview/display.php';
			}

			return root. 'content_site/load/body.php';
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