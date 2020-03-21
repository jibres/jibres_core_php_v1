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


	private static $setupGuide = [];

	private static function check_position($_module)
	{

		$sort =
		[
			'setting',
			'logo',
			'intro',
			'splash',
			'review',
			'apk',
		];

		$subchild = \dash\url::subchild();

		if(!self::$setupGuide)
		{
			self::$setupGuide = \lib\app\application\detail::make_setup_guide();
		}

		$setupGuide = self::$setupGuide;

		$class = '';

		if(isset($setupGuide[$_module]) && $setupGuide[$_module])
		{
			$class = 'complete';
		}
		else
		{
			if($subchild == $_module)
			{
				$class = 'current';
			}
			else
			{
				if(array_search($_module, $sort) < array_search($subchild, $sort))
				{
					$class = 'fail';
				}
				else
				{
					$class = '';
				}
			}

		}

		if($subchild === $_module)
		{
			$class = 'current';
		}

		return $class;

	}


	public static function stepGuide()
	{


		$setting = self::check_position('setting');
		$logo    = self::check_position('logo');
		$intro   = self::check_position('intro');
		$splash  = self::check_position('splash');
		$review  = self::check_position('review');
		$apk     = self::check_position('apk');

		if(\dash\url::subchild() === 'apk')
		{
			$review = 'complete';
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
