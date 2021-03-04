<?php
namespace dash\engine\waf;

class ip
{
	// define waf folder as const
	private static $lastAction = null;

	public static function monitor()
	{
		// try to create folders
		self::checkAndCreateFolders();

		// get ip status
		$ipData = self::fetch();

		// send to court
		$judgment = self::court($ipData);

		// save judgment inside file
		$saveResult = self::save_yaml_file($judgment);

		// do judgment
		self::prosecute($judgment);
	}


	public static function fetch($_ip = null)
	{
		// validate ip
		$myIP = self::validateIP($_ip);
		// open ip file
		$ipData = self::open_ip_file($myIP);

		if($_ip)
		{
			// only Analyze mode
			return self::analyze($myIP, $ipData, true);
		}

		if(!isset($ipData['country']))
		{
			$ipData['country'] = \dash\request::country();
		}
		return self::analyze($myIP, $ipData);
	}


	private static function analyze($_ip, $_fileData, $_onlyAnalyze = null)
	{
		if(!is_array($_fileData))
		{
			$_fileData = [];
		}

		// create array of all fodlers, files, and all data
		$defaultData =
		[
			'ip'         => $_ip,
			'zone'       => null,
			'country'    => null,
			'reqStart'   => null,
			'reqFirst'   => null,
			'reqLast'    => null,
			'reqCounter' => null,
			'reqTotal'   => null,
			'diff'       => null,
			'rpm'        => null,
			'rps'        => null,
			'log'        => [],
			'agent'      => [],
		];
		$data = array_merge($defaultData, $_fileData);

		if(!isset($data['zone']))
		{
			if(\dash\agent::isBot())
			{
				$data['zone'] = 'bot';
			}
			else
			{
				$data['zone'] = 'live';
			}
		}
		// set request count to zero for first request
		if(!isset($data['reqCounter']))
		{
			$data['reqCounter'] = 0;
		}
		if(!isset($data['reqStart']))
		{
			$data['reqStart'] = time();
		}
		if(!isset($data['reqFirst']))
		{
			$data['reqFirst'] = time();
		}
		if(!$_onlyAnalyze)
		{
			// plus request count
			$data['reqCounter'] = $data['reqCounter'] + 1;
			$data['reqTotal']   = $data['reqTotal'] + 1;
		}
		$data['reqLast'] = time();

		// Time difference in seconds from first request to now
		$data['diff']  = $data['reqLast'] - $data['reqFirst'];
		// calc rpm
		if($data['diff'] > 0)
		{
			$data['rpm'] = round(($data['reqCounter'] / ($data['diff'] / 60)), 1 );
			$data['rps'] = round(($data['reqCounter'] / ($data['diff'])), 4 );
		}
		else
		{
			$data['rpm'] = $data['reqCounter'];
			$data['rps'] = $data['reqCounter'];
		}
		if(!$_onlyAnalyze)
		{
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

			$history[time()] =
			[
				'url'     => \dash\url::pwd(),
				'request' => \dash\request::is(),
				'ajax'    => \dash\request::ajax(),
			];
			// save history page
			if(count($history) > 20)
			{
				reset($history);
				unset($history[key($history)]);
			}
		}

		return $data;
	}


	private static function court($_info)
	{
		switch (a($_info, 'zone'))
		{
			case 'live':
			case 'bot':
				if (a($_info, 'diff') > (60 * 60))
				{
					// If first request was more than 1 hour, new ip file
					self::reactive($_info);
				}

				if (a($_info, 'reqCounter') > 120)
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
				if(\dash\request::is('post'))
				{
					$recaptchaResponse = \dash\request::post('g-recaptcha-response');
					if($recaptchaResponse)
					{
						// check recaptcha
						$check_verify = \dash\captcha\recaptcha::verify_v2($recaptchaResponse);

						if($check_verify)
						{
							self::revalidate($_info);
						}
						else
						{
							self::block($_info);
						}
					}
					else
					{
						// block!
						// self::block($_info);
						// first time we are not here, it's live mode
					}
				}
				else
				{
					self::showIpProtectionPage();
				}
				break;


			case 'ban':
				// if it was less than 24 hours and die if so
				if (a($_info, 'diff') > (60 * 60 * 24))
				{
					// 24 hours in seconds.. if more delete ip file
					self::unblock($_info);
				}
				break;

			default:
				break;
		}

		return $_info;
	}


	private static function prosecute($_order)
	{
		// if something happend
		if(self::$lastAction === 'revalidate')
		{
			self::redirectOnce();
		}

		switch (a($_order, 'zone'))
		{
			case 'live':
				break;

			case 'isolation':
				// show ip isolation page
				self::showIpProtectionPage();
				break;

			case 'ban':
				// block until deadline
				self::showIpBlockPage();
				// \dash\header::status(417, 'Your IP is banned for 24 hours, because of too many requests!');
				break;

			default:
				break;
		}
	}


	private static function showIpBlockPage()
	{
		self::redirectOnce();

		\dash\header::set(444);
		require_once (core. 'layout/html/ipBan.php');
		\dash\code::boom();
	}

	private static function showIpProtectionPage()
	{
		self::redirectOnce();

		\dash\header::set(303);
		require_once (core. 'layout/html/ipProtection.php');
		\dash\code::boom();
	}

	private static function redirectOnce()
	{
		if(\dash\request::json_accept() || \dash\request::ajax())
		{
			if(\dash\url::kingdom().'/' === \dash\url::pwd())
			{
				// do nothing
				// echo '{}';
				// echo "\n";
			}
			else
			{
				\dash\notif::direct();
				\dash\redirect::to(\dash\url::kingdom(), true, 307);
			}
		}
		elseif(\dash\request::is('post'))
		{
				\dash\notif::direct();
				\dash\redirect::to(\dash\url::kingdom(), 'jibres', 307);
		}
	}


	private static function isolate(&$_ipData)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'isolate', 'isolation');
	}


	private static function block(&$_ipData)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'block', 'ban');
	}


	private static function unblock(&$_ipData)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'unblock', 'live');
	}


	private static function reactive(&$_ipData)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'reactive');
	}


	private static function revalidate(&$_ipData)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'revalidate', 'live');
	}


	private static function resetRequestLimit(&$_ipData, $_newMode = null, $_newZone = null)
	{
		// set new zone
		if($_newZone)
		{
			// remove current file
			self::delete_yaml_file($_ipData);

			$_ipData['zone'] = $_newZone;
		}

		// log new mode
		if($_newMode)
		{
			self::$lastAction = $_newMode;
			$_ipData['log'][time()] = $_newMode;
		}

		// reset request count
		$_ipData['reqFirst'] = time();
		$_ipData['reqCounter'] = 1;
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


	private static function generate_yaml_path($_data)
	{
		if(!isset($_data['ip']))
		{
			return false;
		}
		if(!isset($_data['zone']))
		{
			return false;
		}
		// create path of save file
		$path = self::generate_file_path($_data['ip'], $_data['zone']);

		return $path;
	}


	private static function delete_yaml_file($_data)
	{
		$path = self::generate_yaml_path($_data);
		if($path)
		{
			if(file_exists($path))
			{
				unlink($path);
				return true;

			}
			return false;
		}

		return null;
	}


	private static function save_yaml_file($_data)
	{
		$path = self::generate_yaml_path($_data);
		if($path)
		{
			if(\dash\yaml::save($path, $_data))
			{
				// okay
				return true;
			}
			return false;
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
			case 'bot':
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
			'bot'       => self::generate_file_path($_ip, 'bot'),
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
			\dash\engine\dog\ip::inspection($_ip);
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
			'bot'       => self::generate_addr_path('bot'),
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
