<?php
namespace dash\engine\waf;

class ip
{
	// define waf folder as const
	private const folderWAF = YARD. 'jibres_waf/';

	private static $IP = null;
	private static $addrLive = null;
	private static $addrIsolation = null;
	private static $addrBan = null;

	public static function monitor()
	{
		// temporary till finish monitor
		if(!\dash\url::isLocal())
		{
			return false;
		}

		self::checkAndCreateFolders();

		// get ip status
		$ipData = self::status();

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
				if(file_exists(self::getFileAddr($myIP)))
				{
					unlink(self::getFileAddr($myIP));
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

				self::saveYaml($myIP, $ipData['firstTry'].'|'.$current .'');
			}
		}
		else
		{
			// If first request or new request after 1 hour / 24 hour ban,
			// new file with <timestamp>|<counter>
			self::set($myIP, 0);
		}
	}


	public static function status($_ip = null)
	{
		$myIP = self::validateIP($_ip);

		// create array of all fodlers, files, and all data
		$result =
		[
			'addr'     =>
			[
				'fileName' => str_replace(':', '-', $myIP). '.yaml',
				'live'     => str_replace(':', '-', $myIP). '.yaml',
			],
			'data'     =>
			[
				'ip'       => $myIP,
				// 'firstTry' => null,
				// 'try'      => null,
				// 'diff'     => null,
				// 'diffm'    => null,
				// 'rpm'      => null,
			],
		];




		$liveIPAddr = self::getFileAddr($_ip);

		if (!file_exists($liveIPAddr))
		{
			return null;
		}


		// get ip file data
		// $ipData = file_get_contents($liveIPAddr);
		$ipData = \dash\yaml::read($liveIPAddr);
		if(!$ipData)
		{
			return $result;
		}
		return;
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


	private static function set($_ip)
	{
		$data =
		[
			'ip'       => $_ip,
			'firstTry' => null,
			'try'      => null,
			'diff'     => null,
			'diffm'    => null,
			'rpm'      => null,
		];

		self::saveYaml($_ip, $data);
	}

	public static function block($_ip, $_from = null, $_to = null)
	{
		if(!$_ip)
		{
			return false;
		}

		$liveIPAddr = self::getFileAddr($_ip);
		$banIPAddr  = self::getFileAddr($_ip, 'ban');

		// block ip address
		if(!$_from)
		{
			$_from = time();
		}

		$fileData = $_from.'|ban';

		// save into file
		self::saveYaml($_ip, $fileData);
		self::saveYaml($_ip, $fileData, 'ban');
	}


	public static function unblock($_ip)
	{
		if(!$_ip)
		{
			return false;
		}

		$liveIPAddr = self::getFileAddr($_ip);
		$banIPAddr  = self::getFileAddr($_ip, 'ban');

		unlink($liveIPAddr);
		unlink($banIPAddr);
	}


	private static function saveYaml($_ip, $_data, $_mode = 'live')
	{
		$fileAddr = self::getFileAddr($_ip, $_mode);
		$dir = dirname($fileAddr);

		// check
		if(!is_dir($dir))
		{
			\dash\file::makeDir($dir, null, true);
		}

		if(\dash\yaml::save($fileAddr, $_data))
		{
			// okay
			return true;
		}

		// some error
		return false;
	}


	private static function saveFile($_ip, $_data, $_mode = 'live')
	{
		$fileAddr = self::getFileAddr($_ip, $_mode);
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


	private static function getFileAddr($_mode)
	{
		switch ($_mode)
		{
			case 'live':
			case 'isolation':
			case 'ban':

				break;

			default:
				return null;
				break;
		}

		// folderAddr
		$ipSecAddr  = YARD.'jibres_waf/'. $_mode. '/';
		// replace : for ipv6
		$_ip = str_replace(':', '-', $_ip);
		// create file addr
		$ipSecAddr  .= $_ip. '.yaml';

		return $ipSecAddr;
	}





	private static function generate_file_path($_ip, $_mode)
	{
		$addrPath = self::generate_addr_path($_mode);
		if($addrPath)
		{
			$fileName = str_replace(':', '-', $_ip). '.yaml';
			$fullPath = $addrPath. $fileName;

			return $fullPath;
		}

		return false;
	}


	private static function generate_addr_path($_mode)
	{
		switch ($_mode)
		{
			case 'live':
			case 'isolation':
			case 'ban':
				break;

			default:
				return false;
				break;
		}

		$fileAddr = self::folderWAF. $_mode. '/';

		return $fileAddr;
	}


	private static function find_ip_path($_ip)
	{
		$myLocations =
		[
			'live'      => self::generate_file_path($_ip, 'live'),
			'isolation' => self::generate_file_path($_ip, 'isolation'),
			'ban'       => self::generate_file_path($_ip, 'ban'),
		];

		$ipPath = null;
		// $myLocation =
		foreach ($myLocations as $key => $loc)
		{
			if(file_exists($loc))
			{
				$ipPath = $loc;
			}
		}

		return $ipPath;
	}


	/**
	 * validateIP address from developer or init
	 * @param  [type] $_ip [description]
	 * @return [type]      [description]
	 */
	private static function validateIP($_ip = null)
	{
		if($_ip)
		{
			// check ip with dog for external requests
			dash\engine\dog\ip::inspection($_ip);
			return $_ip;
		}

		return \dash\server::ip();
	}


	/**
	 * initialize ip folders and fileName
	 * @return [type] [description]
	 */
	private static function checkAndCreateFolders()
	{
		// check folders and create them
		$myFolders =
		[
			'live'      => self::generate_addr_path('live'),
			'isolation' => self::generate_addr_path('isolation'),
			'ban'       => self::generate_addr_path('ban'),
		];

		foreach ($myFolders as $key => $folder)
		{
			if(!is_dir($folder))
			{
				\dash\file::makeDir($folder, null, true);
			}
		}
	}
}
?>
