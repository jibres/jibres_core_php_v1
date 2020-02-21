<?php
namespace dash\engine;

class view
{

	public static function variable()
	{
		// return all parameters and clean it
		\dash\data::requestGET(\dash\request::get());

		// ----- language variable
		\dash\data::lang_list(\dash\language::all(true));
		\dash\data::lang_current(\dash\language::currentAll());
		\dash\data::lang_currentDir(\dash\language::dir());

		\dash\data::lang_default(\dash\language::primary());

		// save all options to use in display
		\dash\data::options(\dash\option::config());

		\dash\data::page_title(null);
		\dash\data::page_seotitle(null);
		\dash\data::page_desc(null);
		\dash\data::page_special(null);

		$user_detail = \dash\user::detail();
		\dash\data::user($user_detail);
		\dash\data::login($user_detail);

		\dash\data::visitor('not ready!');
		// check run progressive web app or not
		\dash\data::runPWA(\dash\detect\device::detectPWA());

		// define default value for global
		\dash\data::global_title(T_("Jibres"));
		// \dash\data::global_login(\dash\user::login());
		// \dash\data::global_lang(\dash\language::current());
		// \dash\data::global_direction(\dash\language::dir());
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

		// make xaccess link
		$xaccessLink = [];
		$xaccessLink['cms'] = \dash\url::kingdom(). '/cms';
		\dash\data::xaccessLink($xaccessLink);


		\dash\data::dev(\dash\option::config('dev'));

		\dash\data::site_title(T_(\dash\option::config('site', 'title')));
		\dash\data::site_desc(T_(\dash\option::config('site', 'desc')));
		\dash\data::site_slogan(T_(\dash\option::config('site', 'slogan')));
		\dash\data::site_logo(\dash\url::icon());
		// set custom logo
		if(\dash\option::config('site', 'logo'))
		{
			\dash\data::site_logo(\dash\url::site(). \dash\option::config('site', 'logo'));
		}

		// add service detail
		\dash\data::service_title(T_('Jibres'));
		\dash\data::service_desc(T_('As easy as ABC is our slogan!'). '<br>'. T_('If you are not finded a solution for your problem, call us.'));
		\dash\data::service_slogan(T_('#1 World Sales Engineering System'));
		\dash\data::service_slogan(T_('Sell and enjoy'));
		\dash\data::service_logo(\dash\url::icon());
		\dash\data::service_url('https://jibres.com');

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
			// set title of locations if exist in breadcrumb
			if(\dash\data::get('breadcrumb', $page_title))
			{
				$page_title = \dash\data::get('breadcrumb', $page_title);
			}
			// replace title of page
			if(!\dash\data::page_special())
			{
				$page_title = ucwords(str_replace('-', ' ', $page_title));
			}

			// translate all title at last step
			$page_title = T_($page_title);

			\dash\data::page_title($page_title);
			// fill page title into seo title
			if(!\dash\data::page_seotitle())
			{
				\dash\data::page_seotitle($page_title);
			}

			if(\dash\data::page_special())
			{
				\dash\data::global_title(\dash\data::page_seotitle());
			}
			else
			{
				\dash\data::global_title(\dash\data::page_seotitle(). ' | '. \dash\data::site_title());
			}
		}
		else
		{
			\dash\data::global_title(\dash\data::site_title());
			// if this page does not have title use site title
			\dash\data::page_title(\dash\data::site_title());
			\dash\data::page_special(true);
		}


		if(!\dash\data::page_desc() && \dash\data::page_desc() !== false && !\dash\url::content())
		{

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
			self::set_title();
			return false;
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

			$txtDesc   = '';
			if(\dash\data::user_displayname())
			{
				$txtDesc .= "<b>". \dash\data::user_displayname(). "</b><br>";
			}
			if(\dash\data::user_mobile())
			{
				$txtDesc .= \dash\fit::mobile(\dash\data::user_mobile());
			}

			$txtFooter = '';
			// $txtFooter .= '<div class="align-center txtC">';
			// $txtFooter .= ' <div>';
			// notification
			// $txtFooter .= '  <a class="btn outline lg" href="'. \dash\url::kingdom(). '/account/notification" title="'. T_("Notifications"). '">'. '<i class="sf-bell"></i>'. '</a>';
			// profile
			// $txtFooter .= '  <a class="btn outline lg" href="'. \dash\url::kingdom(). '/account/profile" title="'. T_("Profile"). '">'. '<i class="sf-user"></i>'. '</a>';
			// billing
			// $txtFooter .= '  <a class="btn outline lg" href="'. \dash\url::kingdom(). '/account/billing" title="'. T_("Billing"). '">'. '<i class="sf-credit-card"></i>'. '</a>';
			// support
			// $txtFooter .= '  <a class="btn outline lg" href="'. \dash\url::kingdom(). '/support" title="'. T_("Support center"). '">'. '<i class="sf-life-ring"></i>'. '</a>';
			// ticket
			// $txtFooter .= '  <a class="btn outline lg" href="'. \dash\url::kingdom(). '/support/ticket" title="'. T_("Tickets"). '">'. '<i class="sf-question-circle"></i>'. '</a>';
			// $txtFooter .= ' </div>';

			// $txtFooter .= '</div>';


			\dash\data::userBadge_desc($txtDesc);
			\dash\data::userBadge_footer($txtFooter);
		}
	}

}
?>
