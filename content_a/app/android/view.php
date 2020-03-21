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

		$setupGuide = \lib\app\application\detail::make_setup_guide();
		\dash\data::setupGuide($setupGuide);

	}



	// call in all module inside android to load detail and run stepGuide
	public static function ready()
	{
		$appDetail = \lib\app\application\detail::get_android();
		\dash\data::appDetail($appDetail);


		$app_queue = \lib\app\application\queue::detail();

		\dash\data::appQueue($app_queue);

		self::stepGuide();
	}



	public static function stepGuide()
	{
		$subchild = \dash\url::subchild();

		$setupGuide = \lib\app\application\detail::make_setup_guide();

		$setting = '';
		$logo    = '';
		$intro   = '';
		$splash  = '';
		$review  = '';
		$apk     = '';


		if(isset($setupGuide['setting']) && $setupGuide['setting'])
		{
			$setting = 'complete';
		}
		else
		{
			if($subchild == 'setting')
			{
				$setting = 'current';
			}
			else
			{
				$setting = 'fail';
			}

		}



		if(isset($setupGuide['logo']) && $setupGuide['logo'])
		{
			$logo = 'complete';
		}
		else
		{
			if($subchild == 'logo')
			{
				$logo = 'current';
			}
			else
			{
				$logo = 'fail';
			}
		}



		if(isset($setupGuide['intro']) && $setupGuide['intro'])
		{
			$intro = 'complete';
		}
		else
		{
			if($subchild == 'intro')
			{
				$intro = 'current';
			}
			else
			{
				$intro = 'fail';
			}
		}


		if(isset($setupGuide['splash']) && $setupGuide['splash'])
		{
			$splash = 'complete';
		}
		else
		{
			if($subchild == 'splash')
			{
				$splash = 'current';
			}
			else
			{
				$splash = 'fail';
			}
		}


		if(isset($setupGuide['review']) && $setupGuide['review'])
		{
			$review = 'complete';
		}
		else
		{
			if($subchild == 'review')
			{
				$review = 'current';
			}
			else
			{
				if($subchild === 'apk')
				{
					$review = 'complete';
				}
				else
				{
					$review = '';
				}
			}
		}


		if(isset($setupGuide['apk']) && $setupGuide['apk'])
		{
			$apk = 'complete';
		}
		else
		{
			if($subchild == 'apk')
			{
				$apk = 'current';
			}
			else
			{
				$apk = '';
			}
		}


		if($subchild == 'setting')
		{
			$setting = 'current';
		}

		if($subchild == 'logo')
		{
			$logo = 'current';
		}

		if($subchild == 'intro')
		{
			$intro = 'current';
		}

		if($subchild == 'splash')
		{
			$splash = 'current';
		}

		if($subchild == 'review')
		{
			$review = 'current';
		}

		if($subchild == 'apk')
		{
			$apk = 'current';
		}


		$mySteps =
		[
			[
				'title' => T_('General Settings'),
				'link'  => \dash\url::that(). '/setting',
				'class' => $setting,
			],
			[
				'title' => T_('App logo'),
				'link'  => \dash\url::that(). '/logo',
				'class' => $logo,
			],
			[
				'title' => T_('App Intro'),
				'link'  => \dash\url::that(). '/intro',
				'class' => $intro,
			],
			[
				'title' => T_('App Splash'),
				'link'  => \dash\url::that(). '/splash',
				'class' => $splash,
			],
			[
				'title' => T_('Review'),
				'link'  => \dash\url::that(). '/review',
				'class' => $review,
			],
			[
				'title' => T_('Generate Your App'),
				'link'  => \dash\url::that(). '/apk',
				'class' => $apk,
			],
		];


		\dash\data::stepGuide($mySteps);
	}
}
?>
