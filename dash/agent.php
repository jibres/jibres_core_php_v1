<?php
namespace dash;

class agent
{
	public static function get($_id = false)
	{
		$agent = self::agent(true);
		if($_id)
		{
			$check_exits_agent = \dash\db\agents::get_agent_detail(md5($agent));

			if($check_exits_agent === null || $check_exits_agent === false)
			{
				return null;
			}

			if(isset($check_exits_agent['id']))
			{
				return floatval($check_exits_agent['id']);
			}

			$is_bot       = self::isBot();

			$agent_detail = \dash\utility\browserDetection::browser_detection('full_assoc');

			// can not detect agent
			if(!$agent)
			{
				return null;
			}

			$insert =
			[
				'agent'    => $agent,
				'agentmd5' => md5($agent),
				'group'    => isset($agent_detail['browser_working']) ? addslashes($agent_detail['browser_working']) : null,
				'name'     => isset($agent_detail['browser_name']) 	  ? addslashes($agent_detail['browser_name']) 	 : null,
				'version'  => isset($agent_detail['browser_number'])  ? addslashes($agent_detail['browser_number'])  : null,
				'os'       => isset($agent_detail['os']) 			  ? addslashes($agent_detail['os']) 			 : null,
				'osnum'    => isset($agent_detail['os_number']) 	  ? addslashes($agent_detail['os_number']) 		 : null,
				'meta'     => json_encode($agent_detail, true),
				'robot'    => $is_bot ? 1 : null,
			];

			$agent_id = \dash\db\agents::insert($insert);

			return $agent_id;
		}
		else
		{
			return $agent;
		}

	}


	/**
	 * return agent of visitor in current page
	 * @return [type] [description]
	 */
	public static function agent($_encode = true)
	{
		$agent = \dash\server::get('HTTP_USER_AGENT');
		// always trim for someone with misconfig
		$agent = trim($agent, '"');
		$agent = trim($agent, "'");

		// if user want encode referer
		if($_encode)
		{
			$agent = urlencode($agent);
		}
		return $agent;
	}



	/**
	 * check current user is bot or not
	 * @return boolean [description]
	 */
	public static function isBot()
	{
		$robot   = null;
		$agent   = self::agent();
		$botlist =
		[
			"Teoma",
			"alexa",
			"froogle",
			"Gigabot",
			"inktomi",
			"looksmart",
			"URL_Spider_SQL",
			"Firefly",
			"NationalDirectory",
			"Ask Jeeves",
			"TECNOSEEK",
			"InfoSeek",
			"WebFindBot",
			"girafabot",
			"crawler",
			"www.galaxy.com",
			"Googlebot",
			"Scooter",
			"Slurp",
			"msnbot",
			"appie",
			"FAST",
			"WebBug",
			"Spade",
			"ZyBorg",
			"rabaz",
			"Baiduspider",
			"Feedfetcher-Google",
			"TechnoratiSnoop",
			"Rankivabot",
			"Mediapartners-Google",
			"Sogou web spider",
			"WebAlta Crawler",
			"TweetmemeBot",
			"Butterfly",
			"Twitturls",
			"Me.dium",
			"Twiceler",
			"inoreader",
			"yoozBot",
			"TelegramBot",
			"Twitterbot",
			"pingbot",
			"MJ12bot",
			"Adsbot",
			"UptimeRobot",
			"AhrefsBot",
			"DotBot",
		];

		foreach($botlist as $bot)
		{
			if(strpos($agent, $bot) !== false)
			{
				$robot = true;
			}
		}
		// return result
		return $robot;
	}


}
?>