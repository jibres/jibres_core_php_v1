<?php
namespace dash\engine;

class view
{

	public static function variable()
	{
		\dash\engine\history::save();

		\dash\data::page_title(null);
		\dash\data::page_seotitle(null);
		\dash\data::page_desc(null);


		// define default value for global
		\dash\data::global_title(T_("Jibres"));
		\dash\data::global_subdomain(\dash\url::subdomain());
		\dash\data::global_content(\dash\url::content());
		if(\dash\data::global_content() === null)
		{
			\dash\data::global_content('site');
		}
		\dash\data::global_page(implode('_', \dash\url::dir()));
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


		\dash\data::site_title(T_(\dash\option::config('site', 'title')));
		\dash\data::site_desc(T_(\dash\option::config('site', 'desc')));
		\dash\data::site_slogan(T_(\dash\option::config('site', 'slogan')));
		\dash\data::site_logo(\dash\url::icon());
		// set custom logo
		if(\dash\option::config('site', 'logo'))
		{
			\dash\data::site_logo(\dash\url::site(). \dash\option::config('site', 'logo'));
		}

		// toggle side bar
		if(\dash\user::sidebar() === null || \dash\user::sidebar() === true)
		{
			\dash\data::userToggleSidebar(true);
		}

		// @todo Javad check browser via new lib
		// \dash\detect\browser::deadbrowserDetection();
	}


	/**
	 * set title for pages depending on condition
	 */
	public static function set_title()
	{
		if($page_title = \dash\data::page_title())
		{
			// translate all title at last step
			$page_title = T_($page_title);
			if(\dash\url::content())
			{
				if(\dash\detect\device::detectPWA())
				{
					// dont add on pwa
				}
				else
				{
					$page_title .= ' | '. \dash\data::site_title();
				}
			}

			\dash\data::page_title($page_title);
			// fill page title into seo title
			if(!\dash\data::page_seotitle())
			{
				\dash\data::page_seotitle($page_title);
			}

			// \dash\data::global_title(\dash\data::page_seotitle(). ' | '. \dash\data::site_title());
			\dash\data::global_title(\dash\data::page_seotitle());
		}
		else
		{
			\dash\data::global_title(\dash\data::site_title());
			// if this page does not have title use site title
			\dash\data::page_title(\dash\data::site_title());

		}

		if(!\dash\data::page_desc())
		{
			// remove page desc
			\dash\data::page_desc(\dash\data::site_desc());
		}


		self::setSocialTitle();
	}


	public static function set_cms_titles()
	{
		if(!\dash\data::get('datarow'))
		{
			if(\dash\url::module() === 'blog')
			{
				\dash\data::page_title(T_("Latest news"));
			}
		}

		// set title
		if(\dash\data::datarow_title())
		{
			\dash\data::page_title(\dash\data::datarow_title());
		}
		// set seo title
		if(\dash\data::datarow_seotitle())
		{
			\dash\data::page_seotitle(\dash\data::datarow_seotitle());
		}

		// set desc
		if(\dash\data::datarow_excerpt())
		{
			\dash\data::page_desc(\dash\data::datarow_excerpt());
		}
		elseif(\dash\data::datarow_content())
		{
			\dash\data::page_desc(\dash\utility\excerpt::extractRelevant(\dash\data::datarow_content()));
		}
		elseif(\dash\data::datarow_desc())
		{
			\dash\data::page_desc(\dash\utility\excerpt::extractRelevant(\dash\data::datarow_desc()));
		}

		// set page cover
		$meta = \dash\data::datarow_meta();
		if(isset($meta['thumb']))
		{
			\dash\data::page_cover($meta['thumb']);
		}

		// set new title
		self::set_title();
	}

	public static function setSocialTitle()
	{
		// if we dont have page image, use site image
		if(\dash\data::page_cover())
		{
			\dash\data::page_twitterCard('summary_large_image');
		}
		elseif(\dash\data::page_video())
		{
			\dash\data::page_twitterCard('player');
		}
		else
		{

			\dash\data::page_cover(\dash\data::site_logo());
			\dash\data::page_twitterCard('summary');
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
	}

}
?>
