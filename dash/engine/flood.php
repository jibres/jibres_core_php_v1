<?php
namespace dash\engine;

class flood
{
	public static function protection()
	{
		self::request_limiter_v1();
	}


	public static function block()
	{
		// block ip address

	}


	private static function request_limiter_v1()
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
		$ipSecLive  = YARD.'jibres_ipsec/live/';
		$ipSecBan   = YARD.'jibres_ipsec/ban/';
		$ipSecWhite = YARD.'jibres_ipsec/white/';

		// check folders exist
		if(!is_dir($ipSecLive))
		{
			\dash\file::makeDir($ipSecLive, null, true);
		}
		if(!is_dir($ipSecBan))
		{
			\dash\file::makeDir($ipSecBan, null, true);
		}
		if(!is_dir($ipSecWhite))
		{
			\dash\file::makeDir($ipSecWhite, null, true);
		}

		// create ip file
		$liveIPAddr .= $ipSecLive. $myIP. '.txt';
		$banIPAddr  .= $ipSecBan. $myIP. '.txt';

		// save current timestamp
		$now = time();


		if (!file_exists($liveIPAddr))
		{
			// If first request or new request after 1 hour / 24 hour ban,
			// new file with <timestamp>|<counter>
			self::saveFile($liveIPAddr, $now.'|0');
		}
		else if (($data = file_get_contents($liveIPAddr)) !== false)
		{
			// Load existing file

			// Create paraset [0] -> timestamp  [1] -> counter
			$data = explode('|', $data);
			$firstTryDate = 0;
			if(isset($data[0]) && $data[0])
			{
				$firstTryDate = (int)$data[0];
			}
			$tryCount = null;
			if(isset($data[1]) && $data[1])
			{
				$tryCount = $data[1];
			}

			// Time difference in seconds from first request to now
			$diff = $now - $firstTryDate;

			if ($tryCount == 'ban')
			{
				// If [1] = ban we check if it was less than 24 hours and die if so
				if ($diff > 86400)
				{
					// 24 hours in seconds.. if more delete ip file
					unlink($liveIPAddr);
					unlink($banIPAddr);
				}
				else
				{
					// \dash\log::set('ipBan');
					\dash\header::status(417, 'Your IP is banned for 24 hours, because of too many requests :(');

					// header("HTTP/1.1 503 Service Unavailable");
					// exit("Your IP is banned for 24 hours, because of too many requests.");
				}
			}
			else if ($diff > 3600)
			{
				// If first request was more than 1 hour, new ip file
				unlink($liveIPAddr);
			}
			else
			{
				// Counter + 1
				$current = (int)$tryCount + 1;

				if ($current > 120)
				{
					// We check rpm (request per minute) after 100 request to get a good ~value
					$rpm = ( $current / ( $diff / 60) );
					if ( $rpm > 10)
					{
						// If there was more than 10 rpm -> ban
						// (if you have a request all 5 secs. you will be banned after ~10 minutes)
						$fileData = $firstTryDate.'|ban';
						self::saveFile($liveIPAddr, $fileData);
						self::saveFile($banIPAddr, $fileData);
						return;
					}
				}

				self::saveFile($liveIPAddr, $firstTryDate.'|'.$current .'');
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
