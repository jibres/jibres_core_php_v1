<?php
namespace dash\waf;

class ip
{
	// define waf folder as const
	private static $lastAction = null;

	public static function monitor()
	{
		// start queue and lock
		\dash\system\session2::startSession();

		// try to create folders
		self::checkAndCreateFolders();

		// get ip status
		$ipData = self::fetch();

		// send to court
		$judgment = self::court($ipData);

		if(!$judgment)
		{
			// do nothing, no judge!
			return null;
		}

		// save judgment inside file
		$saveResult = self::save_yaml_file($judgment);

		// end queue and unlock
		\dash\system\session2::closeSession();

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
			'ratelimit'  =>
			[
				'limit'     => null,
				'remaining' => null,
				'reset'     => null,
			],
			'log'        => [],
			'agent'      => [],
			'race'       => [],
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
		// check  ratelimit
		$data['ratelimit'] = self::ratelimit($data['ratelimit']);

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
			$myAgentMd5 = md5(strval($myAgent));
			if(isset($data['agent'][$myAgentMd5]['name']))
			{
				// do nothing yet
			}
			else
			{
				if(!isset($data['agent'][$myAgentMd5]) || (isset($data['agent'][$myAgentMd5]) && !is_array($data['agent'][$myAgentMd5])))
				{
					$data['agent'][$myAgentMd5] = [];
				}

				$data['agent'][$myAgentMd5]['name']    = $myAgent;
				$data['agent'][$myAgentMd5]['history'] = [];
			}

			if(isset($data['agent'][$myAgentMd5]['history']) && is_array($data['agent'][$myAgentMd5]['history']))
			{
				// nothing
			}
			else
			{
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
			if(count($history) > 3)
			{
				reset($history);
				unset($history[key($history)]);
			}

			// save history for race protection
			$data['race'] = race2::init($data['race']);
		}

		return $data;
	}


	private static function court($_info)
	{
		// whitelist
		$myZone = a($_info, 'zone');
		if($myZone === 'whitelist')
		{
			// do nothing, everything is okay!
			return $_info;
		}

		if($myZone === 'blacklist')
		{
			// do nothing, block everything!
			return $_info;
		}

		if (a($_info, 'diff') > (60 * 60 * 24 * 10))
		{
			// If first request was more than 10 days from last one
			// reset all things
			self::do_reset($_info);
			return null;
		}

		// check agent count limit
		$agents = a($_info, 'agent');
		if(is_array($agents) && count($agents) > 1000)
		{
			// allow only 1000 agent for each ip
			// block one day
			self::do_block($_info, 'reach 1000 agent per ip', 60 * 24);
			return $_info;
		}

		switch ($myZone)
		{
			case 'live':
			case 'human':
			case 'bot':
				if (a($_info, 'diff') > (60 * 60))
				{
					// If first request was more than 1 hour, new ip file
					self::do_reactive($_info, 'return after 1h');
				}

				if(\dash\url::is_api())
				{
					// do nothing on api
				}
				elseif (a($_info, 'reqCounter') > 120)
				{
					// We check rpm (request per minute) after 120 request to get a good ~value
					if ( $_info['rpm'] > 600)
					{
						// If there was more than 60 rpm -> isolation
						// (if you have a request all 5 secs. you will be banned after ~10 minutes)
						self::do_isolate($_info, 'reach more than 60rpm after 120req');
					}
				}
				break;

			case 'isolation':

				if(\dash\url::is_api())
				{
					// do nothing
				}
				else
				{
					// check limit of isolation
					self::checkIsolationLimit($_info);

					if(\dash\request::is('post'))
					{
						$recaptchaResponse = \dash\request::post('g-recaptcha-response');
						if($recaptchaResponse)
						{
							// check recaptcha
							$check_verify = \dash\captcha\recaptcha::verify_v2($recaptchaResponse);

							// remove isolation Data if exist
							self::unsetData($_info, 'isolateRefresh');

							if($check_verify)
							{
								self::do_revalidate($_info, 'recaptcha solved');
								self::plusData($_info, 'recaptchaSolvedCounter');
							}
							else
							{
								// block 1 minute
								self::do_block($_info, 'recaptcha invalid!', 1);
							}
						}
						else
						{
							// block!
							// self::do_block($_info);
							// first time we are not here, it's live mode
						}
					}
				}
				break;


			case 'ban':
				// if it was less than 24 hours and die if so
				if(self::getData($_info, 'autoUnblockCounter') > 5)
				{
					// do nothing for someone with more than 5 times block!
				}
				else
				{
					// if (a($_info, 'diff') > (60 * 60 * 24))
					$unblockTime = self::getData($_info, 'autoUnblockTime');
					if(time() > $unblockTime)
					{
						self::plusData($_info, 'autoUnblockCounter');
						// 24 hours in seconds.. if more delete ip file
						$unblockMsg = 'release after '. self::getData($_info, 'autoUnblockPeriod'). ' min';
						// unblock ip
						self::do_unblock($_info, $unblockMsg);
					}
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
			case 'human':
			case 'bot':
				break;

			case 'isolation':
				if(\dash\url::is_api())
				{
					// do nothing
				}
				else
				{
					// show ip isolation page
					self::showIpProtectionPage();
				}
				break;

			case 'ban':
				// block until deadline
				$unblock_period = \dash\utility\human::timeSecond2Fit(self::getData($_order, 'autoUnblockPeriod') * 60, true);
				$unblock_time   = date('Y-m-d H:i:s', self::getData($_order, 'autoUnblockTime'));
				$unblock_msg    = T_("You are blocked for :period until :time", ['period' => $unblock_period, 'time' => $unblock_time]);

				self::showIpBlockPage($unblock_msg);
				break;

			case 'whitelist':
				break;

			case 'blacklist':
				self::showIpBlockPage();
				break;

			default:
				break;
		}
	}


	private static function showIpBlockPage($_unblockDate = null)
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
		else
		{
			if(trim(\dash\url::kingdom(), '/') !== trim(\dash\url::pwd(), '/'))
			{
				\dash\notif::direct();
				\dash\redirect::to(\dash\url::kingdom(), 'jibres', 307);
			}
		}
	}


	private static function checkIsolationLimit(&$_ipData)
	{
		$currentTry = self::getData($_ipData, 'isolateRefresh', 1);
		$currentTry = intval($currentTry) + 1;
		// try to save data of try
		self::setData($_ipData, 'isolateRefresh', $currentTry);

		if($currentTry > 50)
		{
			self::unsetData($_ipData, 'isolateRefresh');
			// block for too many refresh page
			// block 1 day
			self::do_block($_ipData, 'reach 50 refresh limit', 60 * 1);
		}

		if(self::getData($_ipData, 'recaptchaSolvedCounter') > 10)
		{
			// block 6 hour
			self::do_block($_ipData, 'reach 10 times isolation limit', 60 * 6);
		}
	}


	private static function ratelimit($_ratelimit)
	{
		// [
		// 	'limit'     => null,
		// 	'remaining' => null,
		// 	'reset'     => null,
		// ]
		// define var
		$limit5min = 1000;
		$limit5minReset = time() + (60 * 5);


		if($_ratelimit['reset'])
		{
			if(time() > $_ratelimit['reset'])
			{
				// reset limit 1000 request in 5 min
				$_ratelimit =
				[
					'limit'     => $limit5min,
					'remaining' => $limit5min - 1,
					'reset'     => $limit5minReset,
				];
			}
			else
			{
				// plus limit
				$_ratelimit['remaining'] = $_ratelimit['remaining'] - 1;
			}
		}
		else
		{
			// set limit 1000 request in 5 min
			$_ratelimit =
			[
				'limit'     => $limit5min,
				'remaining' => $limit5min - 1,
				'reset'     => $limit5minReset,
			];
		}

		// set header of ratelimit
		// show only on api
		if(\dash\url::is_api())
		{
			@header("X-Rate-Limit-Limit: ". $_ratelimit['limit']);
			@header("X-Rate-Limit-Remaining: ". $_ratelimit['remaining']);
			@header("X-Rate-Limit-Reset: ". $_ratelimit['reset']);
		}

		// block
		if($_ratelimit['remaining'] <= 0)
		{
			if(!\dash\url::isLocal())
			{
				if(in_array(self::validateIP(), ['151.238.149.136', '147.182.137.236']))
				{
					// jibres office ip
				}
				else
				{
					\dash\header::status(429, 'Rate limit exceeded.');
				}
			}
		}

		return $_ratelimit;
	}


	// set some data inside ipData
	private static function getData($_ipData, $_key,  $_ifNull = null)
	{
		if(isset($_ipData[$_key]))
		{
			return $_ipData[$_key];
		}

		return $_ifNull;
	}


	// set some data inside ipData
	private static function setData(&$_ipData, $_key, $_value)
	{
		$_ipData[$_key] = $_value;
	}


	// set some data inside ipData
	private static function unsetData(&$_ipData, $_key)
	{
		unset($_ipData[$_key]);
	}


	private static function plusData(&$_ipData, $_key)
	{
		$old = self::getData($_ipData, $_key, 0);
		$old = intval($old);
		$_ipData[$_key] = $old + 1;
	}


	private static function do_isolate(&$_ipData, $_reason = null)
	{
		// reset request count
		// self::resetRequestLimit($_ipData, 'isolate', 'isolation', $_reason);
	}


	private static function do_block(&$_ipData, $_reason = null, $_minute = null)
	{
		if(!is_int($_minute) || $_minute < 0)
		{
			// by default block 60 minute
			$_minute = 60;
		}
		// change it to second and create expire datetime
		$unblockTime = time() + ($_minute * 60);
		// save unblock time
		self::setData($_ipData, 'autoUnblockTime', $unblockTime);
		self::setData($_ipData, 'autoUnblockPeriod', $_minute);

		$_reason .= ' - '. $_minute. ' min';

		// reset request count
		self::resetRequestLimit($_ipData, 'block', 'ban', $_reason);
	}


	private static function do_unblock(&$_ipData, $_reason = null)
	{
		// reset block data
		self::unsetData($_ipData, 'autoUnblockTime');
		self::unsetData($_ipData, 'autoUnblockPeriod');

		// reset request count
		self::resetRequestLimit($_ipData, 'unblock', 'live', $_reason);
	}


	private static function do_reactive(&$_ipData, $_reason = null)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'reactive', null, $_reason);
	}


	private static function do_revalidate(&$_ipData, $_reason = null)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'revalidate', 'human', $_reason);
	}


	private static function do_whitelist(&$_ipData, $_reason = null)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'whitelist', 'whitelist', $_reason);
	}


	private static function do_blacklist(&$_ipData, $_reason = null)
	{
		// reset request count
		self::resetRequestLimit($_ipData, 'blacklist', 'blacklist', $_reason);
	}


	private static function do_reset(&$_ipData)
	{
		// reset everything
		self::delete_yaml_file($_ipData);
	}


	private static function do_limit(&$_ipData, $_reason = null, $_minute = null)
	{
		if(!is_int($_minute) || $_minute < 0)
		{
			// by default block 60 minute
			$_minute = 15;
		}
		// change it to second and create expire datetime
		$unblockTime = time() + ($_minute * 60);
		// save unblock time
		self::setData($_ipData, 'ipLimitTime', $unblockTime);
		self::setData($_ipData, 'ipLimitPeriod', $_minute);

		$_reason .= ' - '. $_minute. ' min';

		// reset request count
		self::resetRequestLimit($_ipData, 'limit', null, $_reason);
	}


	// some public function to access from outside
	public static function isolate($_ip = null, $_reason = null, $_level = null)
	{
		$ipData = self::fetch($_ip);
		$isolateNeeded = true;

		// counter for request isolate
		self::plusData($ipData, 'isolateRequested');

		// if true is passed, force isolate in level10
		if($_level === true)
		{
			$_level = 10;
		}

		if($_level < 0 || $_level > 10)
		{
			$_level = 3;
		}
		// only request 5 times, after that request isolate and reset
		if(self::getData($ipData, 'isolateRequested', 1) < 5)
		{
			if(self::getData($ipData, 'recaptchaSolvedCounter') >= $_level)
			{
				// do nothing, it's human for this kind of action
				$isolateNeeded = false;
			}
		}
		else
		{
			self::setData($ipData, 'isolateRequested', 0);
		}

		if($isolateNeeded)
		{
			// do action
			self::do_isolate($ipData, $_reason);
		}
		// save changes
		self::save_yaml_file($ipData);

		if($isolateNeeded)
		{
			// if($_runNow)
			{
				// prosecute commad
				self::prosecute($ipData);
			}
		}
		// return
		return $isolateNeeded;
	}


	public static function isolateIP($_level = null, $_reason = null)
	{
		self::isolate(null, $_reason, $_level, true);
	}


	public static function block($_ip = null, $_reason = null, $_minute = null, $_runNow = null)
	{
		$ipData = self::fetch($_ip);
		// do action
		self::do_block($ipData, $_reason, $_minute);
		// save changes
		self::save_yaml_file($ipData);

		if($_runNow)
		{
			// prosecute commad
			self::prosecute($ipData);
		}
	}


	public static function blockIP($_minute = null, $_reason = null)
	{
		self::block(null, $_reason, $_minute, true);
	}


	public static function unblock($_ip = null, $_reason = null, $_runNow = null)
	{
		$ipData = self::fetch($_ip);
		// do action
		self::do_unblock($ipData, $_reason);
		// save changes
		self::save_yaml_file($ipData);

		if($_runNow)
		{
			// prosecute commad
			self::prosecute($ipData);
		}
	}


	public static function whitelist($_ip, $_reason = null)
	{
		$ipData = self::fetch($_ip);
		// do action
		self::do_whitelist($ipData, $_reason);
		// save changes
		self::save_yaml_file($ipData);
	}


	public static function blacklist($_ip, $_reason = null)
	{
		$ipData = self::fetch($_ip);
		// do action
		self::do_blacklist($ipData, $_reason);
		// save changes
		self::save_yaml_file($ipData);
	}


	public static function limit($_ip = null, $_reason = null, $_minute = null)
	{
		$ipData = self::fetch($_ip);
		// do action
		self::do_limit($ipData, $_reason, $_minute);
		// save changes
		self::save_yaml_file($ipData);
	}


	public static function limitIP($_minute = null, $_reason = null)
	{
		self::limit(null, $_reason, $_minute);
	}


	public static function isLimit($_ip = null)
	{
		$ipData = self::fetch($_ip);
		// read limit time
		$_unlockTime = self::getData($ipData, 'ipLimitTime');

		if(!$_unlockTime)
		{
			return null;
		}

		if(time() > $_unlockTime)
		{
			return false;
		}

		return $_unlockTime;
	}


	private static function resetRequestLimit(&$_ipData, $_newMode = null, $_newZone = null, $_reason = null)
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

			$logDetail = $_newMode;
			if($_reason)
			{
				$logDetail .= ' - '. $_reason;
			}

			if(count($_ipData['log']) > 50)
			{
				$_ipData['log'] = array_slice($_ipData['log'], -50, 50, true)	;
			}

			$_ipData['log'][time()] = $logDetail;

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
			else
			{
				\dash\log::file(json_encode($_data, JSON_UNESCAPED_UNICODE), 'cannotsaveyamlfile.log', 'waf');
				return false;
			}
		}

		\dash\log::file(json_encode($_data, JSON_UNESCAPED_UNICODE), 'cannotsaveyamlfile2.log', 'waf');
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
			case 'human':
			case 'bot':
			case 'isolation':
			case 'ban':
			case 'whitelist':
			case 'blacklist':
				break;

			default:
				return false;
				break;
		}

		$fileAddr = YARD. 'jibres_waf/'. $_mode. '/';

		return $fileAddr;
	}


	/**
	 * Removes an ip file.
	 *
	 * @param      <type>  $_ip    { parameter_description }
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function remove_ip_file(string $_ip)
	{
		$ipPath = self::find_ip_path($_ip);

		if($ipPath)
		{
			return \dash\file::delete($ipPath);
		}

		return false;

	}


	public static function remove_ip_file_folder(string $_ip, $_folder)
	{
		$ipPath = self::generate_file_path($_ip, $_folder);

		if($ipPath)
		{
			return \dash\file::delete($ipPath);
		}

		return false;

	}


	public static function remove_folder($_mode)
	{
		$addr = self::generate_addr_path($_mode);
		if(!$addr)
		{
			return false;
		}

		\dash\file::delete($addr);
	}


	public static function load_folder($_mode)
	{
		$addr = self::generate_addr_path($_mode);
		if(!$addr)
		{
			return false;
		}

		$count_file = self::countFileInFolder($_mode);

		if(is_numeric($count_file) && floatval($count_file) <= 100)
		{
			$list_files = glob($addr. '*');

			$new_list = [];

			if(is_array($list_files))
			{
				foreach ($list_files as $key => $value)
				{
					$new_list[] = str_replace('.yaml', '', basename($value));
				}
			}

			return $new_list;
		}

		return false;
	}


	/**
	 * Opens an ip file.
	 * Use in content_love/ip to load ip file detail
	 *
	 * @param      <type>  $_ip    { parameter_description }
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function open_ip_file($_ip)
	{
		$myFile = self::find_ip_path($_ip);
		if($myFile)
		{
			return \dash\yaml::read($myFile);
		}

		return null;
	}


	public static function find_ip_folder($_ip)
	{
		$myLocations =
		[
			'live'      => self::generate_file_path($_ip, 'live'),
			'human'     => self::generate_file_path($_ip, 'human'),
			'bot'       => self::generate_file_path($_ip, 'bot'),
			'isolation' => self::generate_file_path($_ip, 'isolation'),
			'ban'       => self::generate_file_path($_ip, 'ban'),
			'whitelist' => self::generate_file_path($_ip, 'whitelist'),
			'blacklist' => self::generate_file_path($_ip, 'blacklist'),
		];


		$result = [];

		foreach ($myLocations as $key => $loc)
		{
			if(file_exists($loc))
			{
				$result[] = $key;
			}
		}

		return $result;
	}


	private static function find_ip_path($_ip)
	{
		$myLocations =
		[
			'blacklist' => self::generate_file_path($_ip, 'blacklist'),
			'whitelist' => self::generate_file_path($_ip, 'whitelist'),
			'ban'       => self::generate_file_path($_ip, 'ban'),
			'isolation' => self::generate_file_path($_ip, 'isolation'),
			'bot'       => self::generate_file_path($_ip, 'bot'),
			'human'     => self::generate_file_path($_ip, 'human'),
			'live'      => self::generate_file_path($_ip, 'live'),
		];

		$ipPath = null;
		// $myLocation =
		foreach ($myLocations as $key => $loc)
		{
			if(file_exists($loc))
			{
				if($ipPath)
				{
					\dash\file::delete($loc);
				}
				else
				{
					$ipPath = $loc;
				}
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
			\dash\waf\gate\ip::inspection($_ip);
			return $_ip;
		}

		return \dash\server::ip();
	}


	/**
	 * Check current ip only in whitelisted ip
	 *
	 * @param      array    $_ip    { parameter_description }
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function only_allow_ip($_ip)
	{
		if(!is_array($_ip))
		{
			$_ip = [$_ip];
		}

		if(!in_array(self::validateIP(), $_ip))
		{
			self::blockIP(15, 'is not whitelist');

			// if this function is called by invalid ip
			// the code should be ended !
			\dash\code::boom();
		}

		return true;
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
			'human'     => self::generate_addr_path('human'),
			'bot'       => self::generate_addr_path('bot'),
			'isolation' => self::generate_addr_path('isolation'),
			'ban'       => self::generate_addr_path('ban'),
			'whitelist' => self::generate_addr_path('whitelist'),
			'blacklist' => self::generate_addr_path('blacklist'),
		];

		foreach ($myFolders as $key => $folder)
		{
			if(!is_dir($folder))
			{
				\dash\file::makeDir($folder, null, true);
			}
		}
	}



	public static function countFileInFolder($_folder = null)
	{
		if($_folder)
		{
			$addr = self::generate_addr_path($_folder);
			$count = \dash\file::count_file($addr);
			return $count;
		}
		else
		{
			$result = [];

			$myFolders =
			[
				'live'      => self::generate_addr_path('live'),
				'human'     => self::generate_addr_path('human'),
				'bot'       => self::generate_addr_path('bot'),
				'isolation' => self::generate_addr_path('isolation'),
				'ban'       => self::generate_addr_path('ban'),
				'whitelist' => self::generate_addr_path('whitelist'),
				'blacklist' => self::generate_addr_path('blacklist'),
			];

			foreach ($myFolders as $key => $folder)
			{
				$result[$key] = \dash\file::count_file($folder);
			}

			return $result;
		}


	}
}
?>