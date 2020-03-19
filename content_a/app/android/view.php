<?php
namespace content_a\app\android;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Android Application'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


		$app_queue = \lib\app\application\queue::detail();
		\dash\data::appQueue($app_queue);

	}

	public static function stepSetup()
	{
		$mySteps =
		[
			[
				'title' => T_('General Settings'),
				'link' => \dash\url::that(). '/setting',
				'class' => 'complete',
			],
			[
				'title' => T_('App Intro'),
				'link' => \dash\url::that(). '/intro',
				'class' => 'fail',
			],
			[
				'title' => T_('App Splash'),
				'link' => \dash\url::that(). '/splash',
				'class' => 'current',
			],
			[
				'title' => T_('Review'),
				'link' => \dash\url::that(). '/review',
				'class' => '',
			],
			[
				'title' => T_('Generate Your App'),
				'link' => \dash\url::that(). '/apk',
				'class' => '',
			],
		];

		return $mySteps;
	}
}
?>
