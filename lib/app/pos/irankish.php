<?php
namespace lib\app\pos;


class irankish
{

	public static function config()
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
			$serial = \dash\number::clean($serial);
			if(!\dash\number::is($serial))
			{
				\dash\notif::error(T_("Please set serial as a number"), 'serial');
				return false;
			}

			$serial = abs($serial);
			if(\dash\number::is_larger($serial, 99999999999999999999))
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
			$terminal = \dash\number::clean($terminal);
			if(!\dash\number::is($terminal))
			{
				\dash\notif::error(T_("Please set terminal as a number"), 'terminal');
				return false;
			}

			$terminal = abs($terminal);
			if(\dash\number::is_larger($terminal, 99999999999999999999))
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
			$receiver = \dash\number::clean($receiver);
			if(!\dash\number::is($receiver))
			{
				\dash\notif::error(T_("Please set receiver as a number"), 'receiver');
				return false;
			}

			$receiver = abs($receiver);
			if(\dash\number::is_larger($receiver, 99999999999999999999))
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
			'serial'   => $serial,
			'terminal' => $terminal,
			'receiver' => $receiver,
		];

		return $irankish;
	}

}
?>