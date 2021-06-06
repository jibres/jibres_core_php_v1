<?php
namespace dash\waf;

class race2
{
	public static function init($_data)
	{
		$data = [];
		if(is_array($_data))
		{
			$data = $_data;
		}
		// create key
		$pathAddr = self::request_key();
		$mySessionID = \dash\system\session2::id();

		// save history for race protection
		if(isset($data[$mySessionID][$pathAddr]))
		{
			// do nothing yet
		}
		else
		{
			// add history
			if(!isset($data))
			{
				$data = [];
			}
			if(!isset($data[$mySessionID]) || !is_array($data[$mySessionID]))
			{
				$data[$mySessionID] = [];
			}



			$data[$mySessionID][$pathAddr] =
			[
				'time'    => time(),
				'url'     => self::addr(),
				'request' => \dash\request::is(),
				'ajax'    => \dash\request::ajax(),
			];
		}
		// don't save more than 30 session for each ip
		if(count($data) > 30)
		{
			reset($data);
			unset($data[key($data)]);
		}

		// don't save more than 10 page for each session
		if(is_array($data[$mySessionID]) && count($data[$mySessionID]) > 10)
		{
			reset($data[$mySessionID]);
			unset($data[$mySessionID][key($data[$mySessionID])]);
		}

		return $data;
	}


	private static function request_key()
	{
		return md5(self::addr()). '-'. \dash\request::is();
	}


	private static function addr()
	{
		$url = \dash\url::current();

		// use path for post request
		if(\dash\request::is('get') && \dash\user::id())
		{
			$url = \dash\url::pwa();
		}

		return $url;
	}
}
?>
