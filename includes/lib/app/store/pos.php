<?php
namespace lib\app\store;


class pos
{
	public static function set($_args)
	{
		if(!\lib\store::id())
		{
			return false;
		}

		\dash\app::variable($_args);

		$new_setting = [];

		// irankish setting get
		$irankish = self::irankish();

		if(!$irankish || !is_array($irankish))
		{
			return false;
		}

		$new_setting['irankish'] = $irankish;

		// asanpardakht setting get
		$asanpardakht = self::asanpardakht();

		if(!$asanpardakht || !is_array($irankish))
		{
			return false;
		}

		$new_setting['asanpardakht'] = $asanpardakht;

		// save setting in json
		$pos = \lib\store::detail('pos');

		if(is_string($pos))
		{
			$pos = json_decode($pos, true);
		}

		if(!is_array($pos))
		{
			$pos = [];
		}

		$pos = array_merge($pos, $new_setting);

		$pos = json_encode($pos, JSON_UNESCAPED_UNICODE);

		$result = \lib\db\stores::update(['pos' => $pos], \lib\store::id());

		\lib\store::refresh();

		return true;
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
			'ip'     => $ip,
			'port'   => $port,
		];

		return $asanpardakht;
	}
}
?>