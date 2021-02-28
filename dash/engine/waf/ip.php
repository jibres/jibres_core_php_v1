<?php
namespace dash\engine\waf;

class ip
{
	// define waf folder as const
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
		// try to create folders
		self::checkAndCreateFolders();

		// get ip status
		$ipData = self::fetch();

		// send to court
		$judgment = self::court($ipData);

		// save judgment inside file
		$saveResult = self::save_yaml_file($judgment);
	}


	public static function fetch($_ip = null)
	{
		// validate ip
		$myIP = self::validateIP($_ip);
		// open ip file
		$ipData = self::open_ip_file($myIP);

		return self::analyze($myIP, $ipData);
	}


	private static function analyze($_ip, $_fileData)
	{
		if(!is_array($_fileData))
		{
			$_fileData = [];
		}

		// create array of all fodlers, files, and all data
		$defaultData =
		[
			'ip'       => $_ip,
			'zone'     => null,
			'path'     => null,
			'reqFirst' => null,
			'reqLast'  => null,
			'reqCount' => null,
			'diff'     => null,
			'rpm'      => null,
			'agent'    => [],
			'log'      => [],
		];
		$data = array_merge($defaultData, $_fileData);

		// create path
		if(!isset($data['zone']))
		{
			$data['zone'] = 'live';
		}
		if(!isset($data['path']))
		{
			$data['path'] = self::generate_file_path($_ip, $data['zone']);
		}

		// set request count to zero for first request
		if(!isset($data['reqCount']))
		{
			$data['reqCount'] = 0;
		}
		if(!isset($data['reqFirst']))
		{
			$data['reqFirst'] = time();
		}
		// plus request count
		$data['reqCount'] = $data['reqCount'] + 1;
		$data['reqLast']  = time();

		// Time difference in seconds from first request to now
		$data['diff']  = $data['reqLast'] - $data['reqFirst'];
		// calc rpm
		if($data['diff'] > 0)
		{
			$data['rpm'] = round(($data['reqCount'] / ($data['diff'] / 60)), 1 );
		}
		else
		{
			$data['rpm'] = 0;
		}
		// save agent if not exist
		$myAgent = \dash\agent::agent(false);
		$myAgentMd5 = md5($myAgent);
		if(isset($data['agent'][$myAgentMd5]['name']))
		{
			// do nothing yet
		}
		else
		{
			$data['agent'][$myAgentMd5]['name']    = $myAgent;
			$data['agent'][$myAgentMd5]['history'] = [];
		}
		// add history
		$history = &$data['agent'][$myAgentMd5]['history'];

		$history[time()] = \dash\url::pwd();
		// save 10 history page
		if(count($history) > 10)
		{
			reset($history);
			unset($history[key($history)]);
		}

		return $data;
	}


	private static function court($_info)
	{
		if (a($_info, 'diff') > (60 * 60))
		{
			// If first request was more than 1 hour, new ip file
			// if(file_exists(self::getFileAddr($myIP)))
			// {
			// 	unlink(self::getFileAddr($myIP));
			// }
		}


		switch (a($_info, 'zone'))
		{
			case 'live':
				if (a($_info, 'reqCount') > 120)
				{
					// We check rpm (request per minute) after 120 request to get a good ~value
					if ( $_info['rpm'] > 40)
					{
						// If there was more than 40 rpm -> isolation
						// (if you have a request all 5 secs. you will be banned after ~10 minutes)
						self::isolate($_info);
					}
				}
				break;

			case 'isolation':
				break;


			case 'ban':
				// if it was less than 24 hours and die if so
				if (a($_info, 'diff') > (60 * 60 * 24))
				{
					// 24 hours in seconds.. if more delete ip file
					self::unblock($_info);
				}
				else
				{
					// \dash\header::status(417, 'Your IP is banned for 24 hours, because of too many requests!');
				}
				break;

			default:
				break;
		}
var_dump($_info);

		return $_info;
	}


	private static function isolate(&$_ipData)
	{
		// remove current file
		unlink($_ipData['path']);
		// change zone
		$_ipData['zone'] = 'isolation';
		$_ipData['path'] = self::generate_file_path($_ipData['ip'], 'isolation');
		$_ipData['log'][time()] = 'isolation';
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


	// private static function saveFile($_ip, $_data, $_mode = 'live')
	// {
	// 	$fileAddr = '';
	// 	$dir = dirname($fileAddr);

	// 	// check
	// 	if(!is_dir($dir))
	// 	{
	// 		\dash\file::makeDir($dir, null, true);
	// 	}

	// 	$handle = fopen($fileAddr, 'w+');

	// 	if ($handle)
	// 	{
	// 		// write in file
	// 		if (fwrite($handle, $_data))
	// 		{
	// 			// Chmod to prevent access via web
	// 			chmod($fileAddr, 0700);
	// 		}
	// 		// close file
	// 		fclose($handle);

	// 		// okay
	// 		return true;
	// 	}

	// 	// some error
	// 	return false;
	// }


	private static function save_yaml_file($_data)
	{
		if(!isset($_data['path']))
		{
			return false;
		}

		if(\dash\yaml::save($_data['path'], $_data))
		{
			// okay
			return true;
		}

		// some error
		return false;
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

		$fileAddr = YARD. 'jibres_waf/'. $_mode. '/';

		return $fileAddr;
	}


	private static function open_ip_file($_ip)
	{
		$myFile = self::find_ip_path($_ip);
		if($myFile)
		{
			return \dash\yaml::read($myFile);
		}

		return null;
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
