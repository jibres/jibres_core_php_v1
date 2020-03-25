<?php
namespace content_a\android\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Application Dashboard'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


		$app_queue = \lib\app\application\queue::detail();
		\dash\data::appQueue($app_queue);

		$setupGuide = \lib\app\application\detail::make_setup_guide();
		\dash\data::setupGuide($setupGuide);

		\dash\data::dashboardData(\lib\app\application\download::chart());

		\dash\data::loadScript(true);


	}

}
?>
