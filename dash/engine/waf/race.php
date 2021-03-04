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

		// if we have more than one active request, block others
		if($requestQty > 0)
		{
			// Use this if you want to reset counter
			\dash\header::status(429, 'Please be patient');
		}

		// set busy mode
		self::$isBusy = time();

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
			self::freeThisPageLock();
		}
		else
		{
			$urlMd5          = md5(\dash\url::current());
			$thisPage        = \dash\system\session2::getLock($urlMd5, 'waf_race');
			$lastRequestTime = a($thisPage, 'time');
			$fromLast        = time() - $lastRequestTime;
			if($fromLast > 10)
			{
				// check time
				self::freeThisPageLock();
			}
		}
	}

	private static function freeThisPageLock()
	{
		\dash\system\session2::clean_child('waf_race', md5(\dash\url::current()));
	}

}
?>
