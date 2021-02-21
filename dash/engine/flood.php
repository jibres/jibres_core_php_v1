<?php
namespace dash\engine;

class flood
{
	private static $ipSecAddr = YARD.'jibres_ipsec/';

	public static function protection()
	{
		self::ip_request_limiter_v1();
	}


	public static function block($_ip, $_from = null, $_to = null)
	{
		if(!$_ip)
		{
			return false;
		}

		// check ban folder
		$banFolder = self::$ipSecAddr. 'ban/';
		if(!is_dir($banFolder))
		{
			\dash\file::makeDir($banFolder, null, true);
		}

		$liveIPAddr = self::$ipSecAddr. 'live/'. $_ip. '.txt';
		$banIPAddr  = $banFolder. $_ip. '.txt';

		// block ip address
		if(!$_from)
		{
			$_from = time();
		}

		$fileData = $_from.'|ban';

		// save into file
		self::saveFile($liveIPAddr, $fileData);
		self::saveFile($banIPAddr, $fileData);
	}


	public static function unblock($_ip)
	{
		if(!$_ip)
		{
			return false;
		}

		$liveIPAddr = self::$ipSecAddr. 'live/'. $_ip. '.txt';
		$banIPAddr  = self::$ipSecAddr. 'ban/'. $_ip. '.txt';

		unlink($liveIPAddr);
		unlink($banIPAddr);
	}


	public static function ipStatus($_ip)
	{
		if(!$_ip)
		{
			return false;
		}

		$liveIPAddr = self::$ipSecAddr. 'live/'. $_ip. '.txt';

		// get ip file data
		$ipData = file_get_contents($liveIPAddr);
		if(!$ipData)
		{
			return null;
		}

		// Create paraset [0] -> timestamp  [1] -> counter
		$ipArr = explode('|', $ipData);
		$result =
		[
			'ip'       => $_ip,
			'firstTry' => null,
			'try'      => null,
			'diff'     => null,
			'rpm'      => null,
		];

		if(isset($ipArr[0]) && $ipArr[0])
		{
			$result['firstTry'] = (int)$ipArr[0];

			// Time difference in seconds from first request to now
			$result['diff'] = time() - $result['firstTry'];
		}
		if(isset($ipArr[1]) && $ipArr[1])
		{
			$result['try'] = $ipArr[1];
			// calc rpm
			if($result['diff'])
			{
				$result['rpm'] = intval( ((int)$result['try'] + 1) / ( $result['diff'] / 60) );
			}
		}

		return $result;
	}


	private static function ip_request_limiter_v1()
	{
		// get real ip
		$myIP = \dash\server::ip();
		// check ip exist
		if(!$myIP)
		{
			// \dash\log::set('hiFather!!');
			\dash\header::status(412, 'Hi Father!!');
		}
		// try to check ipsec folder
		$ipSecLive  = self::$ipSecAddr. 'live/';
		$ipSecWhite = self::$ipSecAddr. 'white/';

		// check folders exist
		if(!is_dir($ipSecLive))
		{
			\dash\file::makeDir($ipSecLive, null, true);
		}

		if(!is_dir($ipSecWhite))
		{
			\dash\file::makeDir($ipSecWhite, null, true);
		}

		// create ip file
		$liveIPAddr .= $ipSecLive. $myIP. '.txt';

		// save current timestamp
		$now = time();

		var_dump($ipData = self::ipStatus($myIP));

		if (!file_exists($liveIPAddr))
		{
			// If first request or new request after 1 hour / 24 hour ban,
			// new file with <timestamp>|<counter>
			self::saveFile($liveIPAddr, $now.'|0');
		}
		else if ($ipData = self::ipStatus($myIP))
		{
			if ($ipData['try'] == 'ban')
			{
				// If [1] = ban we check if it was less than 24 hours and die if so
				if ($ipData['diff'] > 86400)
				{
					// 24 hours in seconds.. if more delete ip file
					self::unblock($myIP);
				}
				else
				{
					// \dash\log::set('ipBan');
					\dash\header::status(417, 'Your IP is banned for 24 hours, because of too many requests :(');

					// header("HTTP/1.1 503 Service Unavailable");
					// exit("Your IP is banned for 24 hours, because of too many requests.");
				}
			}
			else if ($ipData['diff'] > 3600)
			{
				// If first request was more than 1 hour, new ip file
				unlink($liveIPAddr);
			}
			else
			{
				// Counter + 1
				$current = (int)$ipData['try'] + 1;

				if ($current > 120)
				{
					// We check rpm (request per minute) after 100 request to get a good ~value
					if ( $ipData['rpm'] > 10)
					{
						// If there was more than 10 rpm -> ban
						// (if you have a request all 5 secs. you will be banned after ~10 minutes)
						self::block($myIP, $ipData['firstTry']);
						return;
					}
				}

				self::saveFile($liveIPAddr, $ipData['firstTry'].'|'.$current .'');
			}
		}
	}


	private static function saveFile($_addr, $_data)
	{
		// open file
		$handle = fopen($_addr, 'w+');

		if ($handle)
		{
			// write in file
			if (fwrite($handle, $_data))
			{
				// Chmod to prevent access via web
				chmod($_addr, 0700);
			}
			// close file
			fclose($handle);

			// okay
			return true;
		}

		// some error
		return false;
	}
}
?>
