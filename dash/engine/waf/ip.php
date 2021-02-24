<?php
namespace dash\engine\waf;

class ip
{
	public static function checkLimit()
	{
		// get real ip
		$myIP = \dash\server::ip();

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
					// \dash\header::status(417, 'Your IP is banned for 24 hours, because of too many requests :(');
				}
			}
			else if (a($ipData, 'diff') > 3600)
			{
				// If first request was more than 1 hour, new ip file
				if(file_exists(self::ipFileAddr($myIP)))
				{
					unlink(self::ipFileAddr($myIP));
				}
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
						// self::block($myIP, $ipData['firstTry']);
						// return;
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


	public static function block($_ip, $_from = null, $_to = null)
	{
		if(!$_ip)
		{
			return false;
		}

		$liveIPAddr = self::ipFileAddr($_ip);
		$banIPAddr  = self::ipFileAddr($_ip, 'ban');

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

		$liveIPAddr = self::ipFileAddr($_ip);
		$banIPAddr  = self::ipFileAddr($_ip, 'ban');

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
		if(!filter_var($_ip, FILTER_VALIDATE_IP))
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
			if($result['diffm'])
			{
				// request per minute
				$result['rpm'] = round( ((int)$result['try']) / $result['diffm'], 1 );
			}
		}

		return $result;
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
		$dir = dirname($fileAddr);

		// check
		if(!is_dir($dir))
		{
			\dash\file::makeDir($dir, null, true);
		}

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
