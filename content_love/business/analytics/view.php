<?php
namespace content_love\business\analytics;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Store analytics"));

				// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$storeAnalytics = \lib\app\store\analytics::summary();

		\dash\data::storeAnalytics($storeAnalytics);
	}
}
?>
