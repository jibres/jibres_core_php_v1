<?php
namespace dash\detect;

class device
{
	private static $DATA = null;

	public static function data($_arg = null)
	{
		if(!self::$DATA)
		{
			self::onset();
		}

		if($_arg)
		{
			if(array_key_exists($_arg, self::$DATA))
			{
				return self::$DATA[$_arg];
			}
			else
			{
				return null;
			}
		}

		// return all of array
		return self::$DATA;
	}


	public static function detectPWA()
	{
		$device = self::data();
		if($device['mobile'])
		{
			if($device['ios'])
			{
				return 'ios';
			}
			else if($device['android'])
			{
				return 'android';
			}
			return true;
		}

		return false;
	}


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

		self::$DATA = $device;
		return $device;
	}
}
?>