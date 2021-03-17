<?php
namespace dash\setting;


class servername
{
	private static $load = null;


	private static function load()
	{
		if(!self::$load)
		{
			$detail = \dash\file::read(__DIR__. '/secret/servername.secret.json');
			if($detail && is_string($detail))
			{
				$detail = json_decode($detail, true);
			}

			if(!is_array($detail))
			{
				$detail = [];
			}

			self::$load = $detail;
		}
	}


	public static function code($_ip)
	{
		$get = self::detail($_ip);

		if(isset($get['code']))
		{
			return $get['code'];
		}

		return null;
	}


	public static function detail($_ip)
	{
		self::load();

		if(isset(self::$load[$_ip]))
		{
			return self::$load[$_ip];
		}

		return null;
	}

}
?>