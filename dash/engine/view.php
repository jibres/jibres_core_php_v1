<?php
namespace dash\engine;

class view
{

	public static function variable()
	{

		\dash\face::title(null);
		\dash\face::seo(null);
		\dash\face::desc(null);


		// define default value for global
		\dash\data::global_title(T_("Jibres"));
		\dash\data::global_subdomain(\dash\url::subdomain());
		\dash\data::global_content(\dash\engine\content::get_name());
		if(\dash\data::global_content() === null)
		{
			\dash\data::global_content('site');
		}

		$myPage = null;
		if(\dash\url::directory())
		{
			$myPage = \dash\str::urldecode(\dash\url::directory());
			// remove non en char
			$myPage = preg_replace('/[^\00-\255]+/u', '', $myPage);
			// remove multi dash
			$myPage = preg_replace('/\-{2,}/', '', $myPage);
			// change slash to underscore
			$myPage = str_replace('/', '_', $myPage);
		}

		\dash\data::global_page($myPage);
		if(!\dash\data::global_page() && \dash\url::module() === null)
		{
			\dash\data::global_page('home');
		}
		// set panel
		\dash\data::global_panel(null);
		// set store
		if(\dash\url::store())
		{
			\dash\data::global_env(\dash\url::store());
		}
		elseif(\dash\engine\store::inStore())
		{
			\dash\data::global_env(\lib\store::code_raw());

		}
		else
		{
			\dash\data::global_env('Jibres');
		}

		\dash\face::site(T_(\dash\face::hereTitle()));
		\dash\face::intro(T_(\dash\face::hereDesc()));
		\dash\face::slogan(T_(\dash\face::siteSlogan()));
		\dash\face::logo(\dash\face::hereIcon());

		\dash\engine\runtime::set('View', 'globalLoaded');
		// load detail of business website
		\dash\layout\business::check_website();
		\dash\engine\runtime::set('View', 'businessSiteLoaded');

		/*=======================================================
		=            Check some variable if In Store            =
		=======================================================*/
		if(\dash\engine\store::inStore())
		{
			// user force set off allow search engine
			// if this option is off or inBusinessSubdomain disallow sarch engine is true
			if(\lib\store::detail('disallowsearchengine') === 'yes' || \dash\engine\store::inBusinessSubdomain())
			{
				\dash\face::disallowSearchEngine(true);
			}
		}
		/*=====  End of Check some variable if In Store  ======*/


		// set custom logo
		// if(\dash\option::config('site', 'logo'))
		// {
		// 	\dash\face::logo(\dash\url::site(). \dash\option::config('site', 'logo'));
		// }

		// toggle side bar
		if(\dash\user::sidebar() === null || \dash\user::sidebar() === true)
		{
			\dash\data::userToggleSidebar(true);
		}
		// add third party to view
		viewThirdParty::append();

		// @todo Javad check browser via new lib
		// \dash\detect\browser::deadbrowserDetection();
	}


	/**
	 * set title for pages depending on condition
	 */
	public static function set_title()
	{
		if($page_title = \dash\face::title())
		{
			// translate all title at last step
			// don't need because on some special modules
			// $page_title = $page_title;

			// set pwa title
			if(!\dash\face::titlePWA())
			{
				\dash\face::titlePWA($page_title);
			}
			// set desktop title
			if(\dash\url::content() || \dash\engine\store::inBusinessWebsite())
			{
				if(\dash\face::specialTitle())
				{
					// do nothing
				}
				else
				{
					$page_title .= ' | '. \dash\face::site();
				}
			}

			if(!\dash\face::headTitle())
			{
				\dash\face::headTitle($page_title);
			}
			// fill page title into seo title
			if(!\dash\face::seo())
			{
				\dash\face::seo($page_title);
			}

			// \dash\data::global_title(\dash\face::seo(). ' | '. \dash\face::site());
			\dash\data::global_title($page_title);
		}
		else
		{
			\dash\data::global_title(\dash\face::site());
			// if this page does not have title use site title
			\dash\face::title(\dash\face::site());

		}

		if(!\dash\face::desc())
		{
			// remove page desc
			\dash\face::desc(\dash\face::intro());
		}


		self::setSocialTitle();
	}


	public static function set_cms_titles()
	{
		if(!\dash\data::get('dataRow'))
		{
			if(\dash\url::module() === 'blog')
			{
				\dash\face::title(T_("Latest news"));
			}
		}


		// set title
		if(\dash\data::dataRow_post_title())
		{
			\dash\face::title(\dash\data::dataRow_post_title());

			// to not put << | site >> force on the page title
			\dash\face::specialTitle(true);
		}
		elseif(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\data::dataRow_title());

			// to not put << | site >> force on the page title
			// \dash\face::specialTitle(true);
		}
		// set seo title
		if(\dash\data::dataRow_seotitle())
		{
			\dash\face::seo(\dash\data::dataRow_seotitle());
		}

		// set desc
		if(\dash\data::dataRow_excerpt())
		{
			\dash\face::desc(\dash\data::dataRow_excerpt());
		}
		elseif(\dash\data::dataRow_content())
		{
			\dash\face::desc(\dash\utility\excerpt::extractRelevant(\dash\data::dataRow_content()));
		}
		elseif(\dash\data::dataRow_desc())
		{
			\dash\face::desc(\dash\utility\excerpt::extractRelevant(\dash\data::dataRow_desc()));
		}

		// set page cover
		if(\dash\data::dataRow_cover())
		{
			\dash\face::cover(\dash\data::dataRow_cover());
		}
		elseif(\dash\data::dataRow_thumb())
		{
			\dash\face::cover(\dash\data::dataRow_thumb());
		}


		if(!\dash\data::back_link() && \dash\url::module())
		{
			\dash\data::back_text(T_("Back"));
			\dash\data::back_link(\dash\url::kingdom());
		}

		// set new title
		self::set_title();
	}

	public static function setSocialTitle()
	{
		// if we dont have page image, use site image
		if(\dash\face::cover())
		{
			if(!\dash\face::twitterCard())
			{
				\dash\face::twitterCard('summary_large_image');
			}
		}
		elseif(\dash\face::video())
		{
			\dash\face::twitterCard('player');
		}
		else
		{
			if(\dash\engine\store::inStore() && \lib\store::logo())
			{
				\dash\face::cover(\lib\store::logo());
			}
			else
			{
				\dash\face::cover(\dash\url::cdn(). '/logo/icon/png/Jibres-Logo-icon-500.png');
			}

			\dash\face::twitterCard('summary');
		}
	}


	public static function lastChanges()
	{
		if(\dash\data::include_adminPanel())
		{
			\dash\data::global_panel('');
			\dash\data::global_siteBuilder(null);

			if(\dash\data::userToggleSidebar() === false)
			{
				\dash\data::global_panel('clean');
			}

			$txtDesc   = '';
			if(\dash\user::detail('displayname'))
			{
				$txtDesc .= "<b>". \dash\user::detail('displayname'). "</b><br>";
			}
			if(\dash\user::detail('mobile'))
			{
				$txtDesc .= \dash\fit::mobile(\dash\user::detail('mobile'));
			}

			\dash\data::userBadge_desc($txtDesc);
		}
		// admin v2
		if(\dash\data::include_m2())
		{
			\dash\data::global_m2(\dash\data::include_m2());
			\dash\data::global_panel(null);
			\dash\data::global_siteBuilder('');
			\dash\data::include_adminPanel(false);
		}
		else
		{
			\dash\data::global_m2(null);
		}

		if(!\dash\face::titlePWA())
		{
			\dash\face::titlePWA(\dash\face::title());
		}

		if(\dash\face::headTitle())
		{
			$filteredTitle = str_replace('"', '', \dash\face::headTitle());
			\dash\face::headTitle($filteredTitle);
		}

		if(\dash\face::seo())
		{
			$filteredSEO = str_replace('"', '', \dash\face::seo());
			\dash\face::seo($filteredSEO);
		}

		if(\dash\face::desc())
		{
			$filteredDesc = str_replace('"', '', \dash\face::desc());
			\dash\face::desc($filteredDesc);
		}
	}

}
?>