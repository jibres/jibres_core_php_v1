<?php
namespace dash\waf;

class race
{
	private static $isBusy = null;

	public static function escort()
	{
		$url        = self::addr();
		$urlMd5     = md5($url);
		$thisPage   = \dash\system\session2::getLock($urlMd5, 'waf_race');
		$requestQty = a($thisPage, 'request');

		if(!$requestQty)
		{
			$requestQty = 0;
		}

		// if we have more than one active request, block others
		if($requestQty > 0)
		{
			$lastRequestTime = a($thisPage, 'time');
			$fromLast        = time() - $lastRequestTime;
			$expireAfter     = 100;

			if(\dash\request::is('post'))
			{
				$expireAfter = 60;
			}
			elseif(\dash\request::is('get'))
			{
				if(\dash\user::id())
				{
					$expireAfter = 5;
				}
				else
				{
					$expireAfter = 10;
				}
			}

			if($fromLast > $expireAfter)
			{
				// clean session temporary variable
				self::freeThisPageLock();
			}
			else
			{
				// Use this if you want to reset counter
				\dash\header::status(429, 'Please be patient');
			}
		}

		// set busy mode
		self::$isBusy = time();

		// set race detection data
		$race =
		[
			'time'    => time(),
			'request' => $requestQty + 1,
			'ip'      => \dash\server::ip(),
			'url'     => $url,
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
			$url             = self::addr();
			$urlMd5          = md5($url);
			$thisPage        = \dash\system\session2::getLock($urlMd5, 'waf_race');
			$lastRequestTime = a($thisPage, 'time');
			$fromLast        = time() - $lastRequestTime;
			if($fromLast > 100)
			{
				// check time
				self::freeThisPageLock();
			}
		}
	}

	private static function freeThisPageLock()
	{
		$url = self::addr();
		\dash\system\session2::clean_child('waf_race', md5($url));
	}


	private static function addr()
	{
		$url = \dash\url::current();

		// use path for post request
		if(\dash\request::is('post'))
		{
			$url = \dash\url::current();
		}
		else if(\dash\user::id())
		{
			$url = \dash\url::pwa();
		}

		return $url;
	}
}
?>
