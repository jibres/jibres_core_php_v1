<?php
namespace dash\engine\waf;

class race
{
	private static $isBusy = null;

	public static function escort()
	{
		$urlMd5     = md5(\dash\url::current());
		$thisPage   = \dash\system\session2::getLock($urlMd5, 'waf_race');
		$requestQty = a($thisPage, 'request');
		if(!$requestQty)
		{
			$requestQty = 0;
		}

		// set race detection data
		$race =
		[
			'time'    => time(),
			'request' => $requestQty + 1,
			'ip'      => \dash\server::ip(),
			'url'     => \dash\url::current(),
		];
		if(\dash\system\session2::set_with_cat('waf_race', $urlMd5, $race))
		{
			// okay. saved
		}
		else
		{
			// fail to save!
		}

		// if we have more than one active request, block others
		if($requestQty > 0)
		{
			// Use this if you want to reset counter
			\dash\header::status(429, 'Please be patient');
		}
		self::$isBusy = time();
	}


	public static function requestDone()
	{
		if(headers_sent())
		{
			return null;
		}

		if(self::$isBusy)
		{
			// clean session temporary variable
			\dash\system\session2::clean_child('waf_race', md5(\dash\url::current()));
		}
		else
		{
			// check time
		}
	}
}
?>
