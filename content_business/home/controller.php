<?php
namespace content_business\home;

class controller
{
	public static function routing()
	{
		\dash\temp::set('InBusinessHomeController', true);

		// load preview section in demo website
		$in_demo_website = \dash\url::subdomain() === 'demo';
		if($in_demo_website)
		{
			if(\dash\url::module() === 'preview')
			{
				$load_preview = \content_site\preview\controller::routing();
				if($load_preview)
				{
					\dash\temp::set('forceLoadNewSiteBuilder', true);

					\dash\data::demoOnlineLoadPreviewSection(true);
					\dash\open::get();
				}
			}
		}
	}
}
?>