<?php
namespace dash\engine;

class flood
{
	public static function protection()
	{
		self::request_limiter_v1();
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
		$fileAddr = YARD.'jibres_ipsec/';
		if(!is_dir($fileAddr))
		{
			\dash\file::makeDir($fileAddr, null, true);
		}
		// create ip file
		$fileAddr .= $myIP. '.txt';
		// save current timestamp
		$now = time();


		if (!file_exists($fileAddr))
		{
			// If first request or new request after 1 hour / 24 hour ban, new file with <timestamp>|<counter>
			if ($handle = fopen($fileAddr, 'w+'))
			{
				if (fwrite($handle, $now.'|0'))
				{
					// Chmod to prevent access via web
					chmod($fileAddr, 0700);
				}
				fclose($handle);
			}
		}
		else if (($data = file_get_contents($fileAddr)) !== false)
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
					unlink($fileAddr);
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
				unlink($fileAddr);
			}
			else
			{
				// Counter + 1
				$current = $tryCount + 1;

				if ($current > 120)
				{
					// We check rpm (request per minute) after 100 request to get a good ~value
					$rpm = ( $current / ( $diff / 60) );
					if ( $rpm > 10)
					{
						// If there was more than 10 rpm -> ban
						// (if you have a request all 5 secs. you will be banned after ~10 minutes)
						if ($handle = fopen($fileAddr, 'w+'))
						{
							// Maybe you like to log the ip once -> die after next request
							fwrite($handle, $firstTryDate.'|ban');
							fclose($handle);
						}
						return;
					}
				}

				if ($handle = fopen($fileAddr, 'w+'))
				{
					// else write counter
					fwrite($handle, $firstTryDate.'|'.$current .'');
					fclose($handle);
				}
			}
		}
	}
}
?>
