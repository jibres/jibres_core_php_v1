<?php
namespace content_my\store\opening;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Big Opening"));

		$subdomain = \dash\session::get('myNewStoreSubdomain');

		\lib\app\store\timeline::set('opening', \dash\session::get('myNewStoreID'));
		\lib\app\store\timeline::clean();

		if($subdomain)
		{
			$lang = null;

			if(\dash\url::lang())
			{
				$lang = '/'. \dash\url::lang();
			}

			// \dash\data::myNewStoreSubdomain(\dash\url::protocol(). '://'. $subdomain. '.'. \dash\url::domain(). $lang. '/a');
			\dash\data::myNewStoreSubdomain(\dash\url::kingdom(). '/'. \dash\coding::encode(\dash\session::get('myNewStoreID')). '/a');
		}
		else
		{
			// no subdomain founded
			\dash\redirect::to(\dash\url::this());
		}

		\dash\data::userToggleSidebar(false);

		if(\dash\detect\device::detectPWA())
		{
			// back
			\dash\data::back_text(T_('My stores'));
			\dash\data::back_link(\dash\url::this());
		}
	}
}
?>