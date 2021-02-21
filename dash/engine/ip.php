<?php
namespace dash\engine;

class ip
{
	private static $ipSecAddr = YARD.'jibres_ipsec/';


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
		self::saveFile($_ip, $fileData);
		self::saveFile($_ip, $fileData, 'ban');
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


	public static function status($_ip)
	{
		if(!$_ip)
		{
			return null;
		}

		// check ip is valid or not
		if(!filter_var($_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
		{
			return false;
		}

		$liveIPAddr = self::ipFileAddr($_ip);

		if (!file_exists($liveIPAddr))
		{
			return null;
		}

		$result =
		[
			'ip'       => $_ip,
			'firstTry' => null,
			'try'      => null,
			'diff'     => null,
			'diffm'     => null,
			'rpm'      => null,
		];

		// get ip file data
		$ipData = file_get_contents($liveIPAddr);
		if(!$ipData)
		{
			return $result;
		}

		// Create paraset [0] -> timestamp  [1] -> counter
		$ipArr = explode('|', $ipData);

		if(isset($ipArr[0]) && $ipArr[0])
		{
			$result['firstTry'] = (int)$ipArr[0];

			// Time difference in seconds from first request to now
			$result['diff'] = time() - $result['firstTry'];
			$result['diffm'] = intval((time() - $result['firstTry']) / 60);
		}
		if(isset($ipArr[1]) && $ipArr[1])
		{
			$result['try'] = $ipArr[1];
			// calc rpm
			if($result['diff'])
			{
				// request per minute
				$result['rpm'] = intval( ((int)$result['try']) / $result['diffm'] );
			}
		}

		return $result;
	}


	public static function checkLimit()
	{
		// get real ip
		$myIP = self::ip();

		// try to check ipsec folder
		$ipSecAddr  = self::$ipSecAddr. 'live/';
		// $ipSecWhite = self::$ipSecAddr. 'white/';

		// check folders exist
		if(!is_dir($ipSecAddr))
		{
			\dash\file::makeDir($ipSecLive, null, true);
		}

		// if(!is_dir($ipSecWhite))
		// {
		// 	\dash\file::makeDir($ipSecWhite, null, true);
		// }

		// create ip file
		$liveIPAddr .= $ipSecLive. $myIP. '.txt';

		// get ip status
		$ipData = self::status($myIP);

		if ($ipData)
		{
			if (a($ipData, 'try') === 'ban')
			{
				// if it was less than 24 hours and die if so
				if (a($ipData, 'diff') > 86400)
				{
					// 24 hours in seconds.. if more delete ip file
					self::unblock($myIP);
				}
				else
				{
					// \dash\log::set('ipBan');
					\dash\header::status(417, 'Your IP is banned for 24 hours, because of too many requests :(');
				}
			}
			else if (a($ipData, 'diff') > 3600)
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

				self::saveFile($myIP, $ipData['firstTry'].'|'.$current .'');
			}
		}
		else
		{
			// If first request or new request after 1 hour / 24 hour ban,
			// new file with <timestamp>|<counter>
			self::saveFile($myIP, time().'|0');
		}
	}


	private static function ip()
	{
		// get real ip
		$myIP = \dash\server::ip();

		// check ip exist
		if(!$myIP)
		{
			// \dash\log::set('hiFather!!');
			\dash\header::status(412, 'Hi Father!!');
		}

		return $myIP;
	}


	private static function ipFileAddr($_ip, $_mode = 'live')
	{
		switch ($_mode)
		{
			case 'live':
			case 'ban':

				break;

			default:
				return null;
				break;
		}

		// folderAddr
		$ipSecAddr  = YARD.'jibres_ipsec/'. $_mode. '/';
		// replace : for ipv6
		$_ip = str_replace(':', '-', $_ip);
		// create file addr
		$ipSecAddr  .= $_ip. '.txt';

		return $ipSecAddr;
	}


	private static function saveFile($_ip, $_data, $_mode = 'live')
	{
		$fileAddr = self::ipFileAddr($_ip, $_mode);

		$handle = fopen($fileAddr, 'w+');

		if ($handle)
		{
			// write in file
			if (fwrite($handle, $_data))
			{
				// Chmod to prevent access via web
				chmod($fileAddr, 0700);
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
