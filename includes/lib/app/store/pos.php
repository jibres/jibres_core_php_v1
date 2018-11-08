<?php
namespace lib\app\store;


class pos
{
	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			return false;
		}

		\dash\app::variable($_args);

		$pos = \dash\app::request('pos');

		if(!$pos)
		{
			\dash\notif::error(T_("Please choose your pos"), 'pos');
			return false;
		}

		$title = \dash\app::request('title');

		if($title && mb_strlen($title) > 100 )
		{
			\dash\notif::error(T_("Please set your title less than 100 character"), 'title');
			return false;
		}

		$allow_pos =
		[
			'saderat', 'mellat', 'tejarat', 'melli', 'sepah', 'keshavarzi',
			'parsian', 'maskan', 'refah', 'novin', 'ansar', 'pasargad',
			'saman', 'sina', 'post', 'ghavamin', 'taavon', 'shahr', 'ayande',
			'sarmayeh', 'day', 'hekmat', 'iranzamin', 'karafarin', 'gardeshgari',
			'madan', 'tsaderat', 'khavarmiyane', 'ivbb', 'irkish', 'asanpardakht',
			'zarinpal', 'payir',
		];

		if(!in_array($pos, $allow_pos))
		{
			\dash\notif::error(T_("Invalid pos"), 'pos');
			return false;
		}

		$old = self::list(true);

		$default = false;
		if(count($old) === 0)
		{
			$default = true;
		}

		$pc_pos = null;
		if($pos === 'irkish')
		{
			// irankish setting get
			$pc_pos = self::irankish();

			if(!$pc_pos || !is_array($pc_pos))
			{
				return false;
			}
		}

		if($pos === 'asanpardakht')
		{
			// asanpardakht setting get
			$pc_pos = self::asanpardakht();

			if(!$pc_pos || !is_array($pc_pos))
			{
				return false;
			}
		}

		$old[] =
		[
			'title'   => $title,
			'name'    => $pos,
			'class'   => $pos,
			'pc_pos'  => $pc_pos,
			'default' => $default,
		];

		$pos = json_encode($old, JSON_UNESCAPED_UNICODE);

		$result = \lib\db\stores::update(['pos' => $pos], \lib\store::id());

		\lib\store::refresh();

		return true;
	}


	public static function remove($_key)
	{
		$old = self::list(true);

		if(!array_key_exists($_key, $old))
		{
			\dash\notif::error(T_("This pos not found in your store"));
			return false;
		}

		if(isset($old[$_key]['default']) && $old[$_key]['default'])
		{
			unset($old[$_key]);
			$old = array_values($old);

			foreach ($old as $key => $value)
			{
				if($key == 0)
				{
					$old[$key]['default'] = true;
				}
				else
				{
					$old[$key]['default'] = false;
				}
			}
		}
		else
		{
			unset($old[$_key]);
		}

		$pos = json_encode($old, JSON_UNESCAPED_UNICODE);

		$result = \lib\db\stores::update(['pos' => $pos], \lib\store::id());

		\lib\store::refresh();

		return true;

	}


	public static function default($_key)
	{
		$old = self::list(true);

		if(!array_key_exists($_key, $old))
		{
			\dash\notif::error(T_("This pos not found in your store"));
			return false;
		}

		foreach ($old as $key => $value)
		{
			if($key == $_key)
			{
				$old[$key]['default'] = true;
			}
			else
			{
				$old[$key]['default'] = false;
			}
		}

		$pos = json_encode($old, JSON_UNESCAPED_UNICODE);

		$result = \lib\db\stores::update(['pos' => $pos], \lib\store::id());

		\lib\store::refresh();

		return true;

	}


	public static function list($_all = false)
	{
		$pos = \lib\store::detail('pos');

		if(is_string($pos))
		{
			$pos = json_decode($pos, true);
		}

		if(!is_array($pos))
		{
			$pos = [];
		}

		if($_all)
		{
			return $pos;
		}
		else
		{
			$new = [];
			foreach ($pos as $key => $value)
			{
				if(isset($value['status']) && $value['status'])
				{
					$new[$key] = $value;
				}
			}
			return $new;
		}
	}




	private static function irankish()
	{
		$irankish = \dash\app::request('irankish') ? true : false;

		$serial = \dash\app::request('serial');
		if($serial && !is_numeric($serial))
		{
			\dash\notif::error(T_("Please set serial as a number"), 'serial');
			return false;
		}

		if($serial)
		{
			$serial = intval($serial);
			$serial = abs($serial);
			if($serial > 1E+20)
			{
				\dash\notif::error(T_("Serial is out of range"), 'serial');
				return false;
			}
		}
		else
		{
			$serial = null;
		}

		$terminal = \dash\app::request('terminal');
		if($terminal && !is_numeric($terminal))
		{
			\dash\notif::error(T_("Please set terminal as a number"), 'terminal');
			return false;
		}

		if($terminal)
		{
			$terminal = intval($terminal);
			$terminal = abs($terminal);
			if($terminal > 1E+20)
			{
				\dash\notif::error(T_("Terminal is out of range"), 'terminal');
				return false;
			}
		}
		else
		{
			$terminal = null;
		}

		$receiver = \dash\app::request('receiver');
		if($receiver && !is_numeric($receiver))
		{
			\dash\notif::error(T_("Please set receiver as a number"), 'receiver');
			return false;
		}

		if($receiver)
		{
			$receiver = intval($receiver);
			$receiver = abs($receiver);
			if($receiver > 1E+20)
			{
				\dash\notif::error(T_("Receiver is out of range"), 'receiver');
				return false;
			}
		}
		else
		{
			$receiver = null;
		}

		$irankish =
		[
			'status'   => $irankish,
			'title'    => "irankish pc pos",
			'serial'   => $serial,
			'terminal' => $terminal,
			'receiver' => $receiver,
		];

		return $irankish;
	}


	private static function asanpardakht()
	{
		$asanpardakht = \dash\app::request('asanpardakht') ? true : false;

		$ip = \dash\app::request('ip');
		if($ip && !filter_var($ip, FILTER_VALIDATE_IP))
		{
			\dash\notif::error(T_("Please set a valid ip address"), 'ip');
			return false;
		}

		if(!$ip)
		{
			$ip = null;
		}

		$port = \dash\app::request('port');
		if($port && !is_numeric($port))
		{
			\dash\notif::error(T_("Please set port as a number"), 'port');
			return false;
		}

		// @ if change need remove this line
		$port = 447700;

		if($port)
		{
			$port = intval($port);
			$port = abs($port);
			if($port > 1E+6)
			{
				\dash\notif::error(T_("Port is out of range"), 'port');
				return false;
			}
		}
		else
		{
			$port = null;
		}


		$asanpardakht =
		[
			'status' => $asanpardakht,
			'title'  => "asanpardakht pc pos",
			'ip'     => $ip,
			'port'   => $port,
		];

		return $asanpardakht;
	}
}
?>