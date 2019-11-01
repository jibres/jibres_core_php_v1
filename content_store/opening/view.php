<?php
namespace content_store\opening;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Big Opening"));

		$subdomain = \dash\session::get('myNewStoreId');

		\lib\app\store\timeline::set('opening');

		if($subdomain)
		{
			$lang = null;

			if(\dash\url::lang())
			{
				$lang = '/'. \dash\url::lang();
			}

			\dash\data::myNewStoreId(\dash\url::protocol(). '://'. $subdomain. '.'. \dash\url::domain(). $lang. '/a');
		}
		else
		{
			// no subdomain founded
			\dash\redirect::to(\dash\url::here());
		}

		\dash\data::userToggleSidebar(false);
	}
}
?>