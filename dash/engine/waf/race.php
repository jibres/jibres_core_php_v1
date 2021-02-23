<?php
namespace dash\engine\waf;

class race
{
	public static function escort()
	{
		$escortData = \dash\system\session2::getLock('escort', 'waf');
		$urlMd5     = md5(\dash\url::current());
		$thisPage   = a($escortData, $urlMd5);
		$requestQty = a($thisPage, 'request');
		if(!$requestQty)
		{
			$requestQty = 0;
		}


		// set flood data detection
		$flood['escort'][$urlMd5] =
		[
			'time'    => time(),
			'request' => $requestQty + 1,
			'ip'      => \dash\server::ip(),
			'url'     => \dash\url::current(),
		];
		if(\dash\system\session2::set('waf', $flood))
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
	}

	public static function requestDone()
	{
		$urlMd5 = md5(\dash\url::current());
		// \dash\system\session2::clean_sub_child('waf', 'escort', $urlMd5);
		$flood['escort'][$urlMd5] =
		[
			'time'    => time(),
			'request' => null,
			'ip'      => \dash\server::ip(),
			'url'     => \dash\url::current(),
		];

		if(\dash\system\session2::set('waf', $flood))
		{
			// okay. saved
		}
		else
		{
			// fail to save!
		}
		// var_dump($_SESSION);
	}
}
?>
