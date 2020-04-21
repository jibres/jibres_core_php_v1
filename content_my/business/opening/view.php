<?php
namespace content_my\business\opening;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Big Opening"));

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
			\dash\data::myNewStoreSubdomain(\dash\url::kingdom(). '/'. \dash\store_coding::encode(\dash\session::get('myNewStoreID')). '/a');
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
			\dash\data::back_text(T_('My business'));
			\dash\data::back_link(\dash\url::this());
		}
	}
}
?>