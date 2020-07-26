<?php
namespace dash\engine;

class view
{

	public static function variable()
	{
		\dash\engine\history::save();

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

		$myPage = urldecode(\dash\url::directory());
		// remove non en char
		$myPage = preg_replace('/[^\00-\255]+/u', '', $myPage);
		// remove multi dash
		$myPage = preg_replace('/\-{2,}/', '', $myPage);

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
		else
		{
			\dash\data::global_env('Jibres');
		}

		\dash\face::site(T_(\dash\face::siteTitle()));
		\dash\face::intro(T_(\dash\face::siteDesc()));
		\dash\face::slogan(T_(\dash\face::siteSlogan()));
		\dash\face::logo(\dash\url::icon());

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


		\dash\data::googleAnalytics(self::google_analytics());

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
			$page_title = T_($page_title);
			// set pwa title
			if(!\dash\face::titlePWA())
			{
				\dash\face::titlePWA($page_title);
			}
			// set desktop title
			\dash\face::title($page_title);
			if(\dash\url::content())
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

			\dash\face::headTitle($page_title);
			// fill page title into seo title
			if(!\dash\face::seo())
			{
				\dash\face::seo($page_title);
			}

			// \dash\data::global_title(\dash\face::seo(). ' | '. \dash\face::site());
			\dash\data::global_title(\dash\face::seo());
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
		if(!\dash\data::get('datarow'))
		{
			if(\dash\url::module() === 'blog')
			{
				\dash\face::title(T_("Latest news"));
			}
		}

		// set title
		if(\dash\data::datarow_title())
		{
			\dash\face::title(\dash\data::datarow_title());
		}
		// set seo title
		if(\dash\data::datarow_seotitle())
		{
			\dash\face::seo(\dash\data::datarow_seotitle());
		}

		// set desc
		if(\dash\data::datarow_excerpt())
		{
			\dash\face::desc(\dash\data::datarow_excerpt());
		}
		elseif(\dash\data::datarow_content())
		{
			\dash\face::desc(\dash\utility\excerpt::extractRelevant(\dash\data::datarow_content()));
		}
		elseif(\dash\data::datarow_desc())
		{
			\dash\face::desc(\dash\utility\excerpt::extractRelevant(\dash\data::datarow_desc()));
		}

		// set page cover
		$meta = \dash\data::datarow_meta();
		if(isset($meta['thumb']))
		{
			\dash\face::cover($meta['thumb']);
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

			\dash\face::cover(\dash\url::cdn(). '/logo/icon/png/Jibres-Logo-icon-500.png');
			\dash\face::twitterCard('summary');
		}
	}


	public static function lastChanges()
	{
		if(\dash\data::include_adminPanel())
		{
			\dash\data::global_panel(true);
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

		if(!\dash\face::titlePWA())
		{
			\dash\face::titlePWA(\dash\face::title());
		}
	}


	private static function google_analytics()
	{
		// supersaeed guid
		// UA-130946685-3
		$google_analytics = null;

		if(\dash\url::tld() === 'ir')
		{
			$jibres_google_analytics = 'UA-130946685-2';
		}
		else
		{
			$jibres_google_analytics = 'UA-130946685-1';
		}


		if(!\dash\engine\store::inStore())
		{
			$google_analytics = $jibres_google_analytics;
		}
		else
		{
			if(\lib\store::detail('google_analytics'))
			{
				$google_analytics = \lib\store::detail('google_analytics');
			}
			else
			{
				$google_analytics = $jibres_google_analytics;
			}
		}

		return $google_analytics;
	}
}
?>
