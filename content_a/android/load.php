<?php
namespace content_a\android;


class load
{

	// call in all module inside android to load detail and run stepGuide
	public static function detail()
	{
		$appDetail = \lib\app\application\detail::get_android();
		\dash\data::appDetail($appDetail);


		$app_queue = \lib\app\application\queue::detail();
		if(isset($app_queue['status']) && $app_queue['status'])
		{
			\dash\data::appQueue($app_queue);
		}

		$splashSaved = \lib\app\application\splash::get_android();
		\dash\data::splashSaved($splashSaved);
		if(\dash\request::get('setup') === 'wizard')
		{
			\dash\data::nextBtn(T_('Save & Next'));
			\dash\data::nextBtnAll(T_('Save All & Next'));
		}
		else
		{
			\dash\data::nextBtn(T_('Save'));
			\dash\data::nextBtnAll(T_('Save All'));
		}

		self::stepGuide();
	}


	private static $setupGuide = [];

	private static function check_position($_module)
	{

		$sort =
		[
			'logo',
			'setting',
			'splash',
			'intro',
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

		$app_queue = \lib\app\application\queue::detail();
		if($app_queue && isset($app_queue['status']) && in_array($app_queue['status'], ['inprogres', 'done']) && $review == '')
		{
			$review = 'complete';
		}

		if($app_queue && isset($app_queue['status']) && in_array($app_queue['status'], ['inprogres', 'done']) && $apk == '')
		{
			$apk = 'complete';
		}

		if(\dash\url::subchild() === 'apk')
		{
			$review = 'complete';
		}

		$get_wizard = '';
		if(\dash\request::get('setup') === 'wizard')
		{
			$get_wizard = '?setup=wizard';
		}


		$mySteps =
		[
			[
				'title' => T_('App logo'),
				'link'  => \dash\url::this(). '/logo'. $get_wizard,
				'class' => $logo,
			],
			[
				'title' => T_('General Settings'),
				'link'  => \dash\url::this(). '/setting'. $get_wizard,
				'class' => $setting,
			],
			[
				'title' => T_('App Splash'),
				'link'  => \dash\url::this(). '/splash'. $get_wizard,
				'class' => $splash,
			],
			[
				'title' => T_('App Intro'),
				'link'  => \dash\url::this(). '/intro'. $get_wizard,
				'class' => $intro,
			],
			[
				'title' => T_('Review'),
				'link'  => \dash\url::this(). '/review'. $get_wizard,
				'class' => $review,
			],
		];


		\dash\data::stepGuide($mySteps);
	}
}
?>
