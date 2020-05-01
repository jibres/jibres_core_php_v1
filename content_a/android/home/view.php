<?php
namespace content_a\android\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Application Dashboard'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


		$app_queue = \lib\app\application\queue::detail();
		\dash\data::appQueue($app_queue);

		if(isset($app_queue['status']) && $app_queue['status'])
		{
			// action
			\dash\data::action_text(T_('Application status'));
			\dash\data::action_link(\dash\url::this(). '/apk');
		}
		else
		{
			// action
			\dash\data::action_text(T_('Setup Your app'));
			\dash\data::action_link(\dash\url::this(). '/logo?setup=wizard');
		}


		$setupGuide = \lib\app\application\detail::make_setup_guide();
		\dash\data::setupGuide($setupGuide);

		\dash\data::dashboardData(\lib\app\application\download::chart());

		$stat = \lib\app\application\download::stat();
		\dash\data::stat($stat);


		\dash\data::script_page('/js/chart/a/androiddashboard.js');


	}

}
?>
