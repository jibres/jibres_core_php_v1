<?php
namespace dash\engine;

class view
{

	public static function variable()
	{
		// load customer business website
		if(\dash\engine\content::get() === 'content_business' && \dash\engine\store::inBusinessWebsite())
		{
			// load detail of business website
			\dash\layout\business::check_website();
		}

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
		// change slash to underscore
		$myPage = str_replace('/', '_', $myPage);

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


		\dash\data::addons_googleAnalytics(self::addon_googleAnalytics());
		\dash\data::addons_tawk(self::addon_tawk());
		\dash\data::addons_raychat(self::addon_raychat());


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
		if(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\data::dataRow_title());
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
		$meta = \dash\data::dataRow_meta();
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


	private static function addon_googleAnalytics()
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


	private static function addon_tawk()
	{
		if(\dash\engine\store::inStore())
		{
			if(\lib\store::detail('addon_tawk'))
			{
				return \lib\store::detail('addon_tawk');
			}
		}
		else
		{
			switch (\dash\url::tld())
			{
				case 'ir':
					return '5fc8dc17a1d54c18d8f00574';
					break;

				case 'com':
					return '5fdb8b03a8a254155ab44bbd';
					break;

				default:
					return null;
					break;
			}
		}

		return null;
	}


	private static function addon_raychat()
	{
		return null;

		if(\dash\engine\store::inStore())
		{
			if(\lib\store::detail('addon_raychat'))
			{
				return \lib\store::detail('addon_raychat');
			}
		}
		else
		{
			if(\dash\url::tld() === 'ir')
			{
				return '753a218c-a747-4aa1-a637-c3e8552bde75';
			}
			elseif(\dash\url::tld() === 'local')
			{
				return '9e05444f-b316-4e42-b85d-40e18c4ff8d7';
			}
		}

		return null;
	}

}
?>
