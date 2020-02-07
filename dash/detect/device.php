<?php
namespace dash\detect;

class device
{
	public static function onset()
	{
		require_once(core.'detect/Mobile_Detect.php');
		$detect = new \Mobile_Detect;

		$device =
		[
			'mobile'     => $detect->isMobile(),
			'tablet'     => $detect->isTablet(),
			'onlyMobile' => $detect->isMobile() && !$detect->isTablet(),

			'ios'        => $detect->isiOS(),
			'android'    => $detect->isAndroidOS(),


			'iphone'     => $detect->isIphone(),
			'samsung'    => $detect->isSamsung(),
			'androidVer' => $detect->version('Android'),

			'Chrome'     => $detect->is('Chrome'),
			'UCBrowser'  => $detect->is('UCBrowser'),
			'Opera'      => $detect->is('Opera'),

			'grade'      => $detect->mobileGrade(),

		];

		// var_dump($device);
	}
}
?>