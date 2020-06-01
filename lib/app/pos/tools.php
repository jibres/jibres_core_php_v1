<?php
namespace lib\app\pos;


class tools
{
	public static function default($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$get = \lib\db\pos\get::by_id($_id);
		if(!$get)
		{
			\dash\notif::error(T_("Pos detail not found"));
			return false;
		}

		\lib\db\pos\update::set_default($_id);
		return true;
	}



	public static function pc_pos_btn()
	{
		$fund_login_id = \lib\app\fund\login::get();

		if(!$fund_login_id)
		{
			$pos_default = \lib\db\pos\get::default_pos();
		}
		else
		{
			$load_fund = \lib\app\fund\get::get($fund_login_id);
			if(isset($load_fund['pos'][0]) && is_numeric($load_fund['pos'][0]))
			{
				$pos_default = \lib\db\pos\get::by_id($load_fund['pos'][0]);
			}
		}

		// no pos default founded
		if(!isset($pos_default['id']) || !is_array($pos_default) || !array_key_exists('pcpos', $pos_default))
		{
			return null;
		}

		// default pos is not pc pos
		if(!$pos_default['pcpos'])
		{
			return null;
		}

		// check support pcpos in JibresBooster
		if(!in_array($pos_default['slug'], ['asanpardakht', 'irkish']))
		{
			return null;
		}

		if($pos_default['slug'] === 'irkish')
		{
			$pc_pos   = $pos_default['setting'];
			$pc_pos   = json_decode($pc_pos, true);

			// no config for pcpos
			if(!is_array($pc_pos))
			{
				return null;
			}

			$serial   = isset($pc_pos['serial']) ? $pc_pos['serial'] : null;
			$terminal = isset($pc_pos['terminal']) ? $pc_pos['terminal'] : null;
			$receiver = isset($pc_pos['receiver']) ? $pc_pos['receiver'] : null;
			$link     = 'http://localhost:9759/jibres/?type=PcPosKiccc';
			$link     .= '&serial='. $serial;
			$link     .= '&terminal='. $terminal;
			$link     .= '&acceptor='. $receiver;
			$link     .= '&sum=$';

			$pos_default['link'] = $link;

			\dash\data::pcPosLink($pos_default);
		}
		elseif($pos_default['slug'] === 'asanpardakht')
		{
			$pc_pos   = $pos_default['setting'];
			$pc_pos   = json_decode($pc_pos, true);

			// no config for pcpos
			if(!is_array($pc_pos))
			{
				return null;
			}

			$ip   = isset($pc_pos['ip']) ? $pc_pos['ip'] : null;
			$port = isset($pc_pos['port']) ? $pc_pos['port'] : null;
			$link  = 'http://localhost:9759/jibres/?type=PcPosAsanpardakht';
			$link .= '&ip='. $ip;
			$link .= '&invoice='. time();
			if($port)
			{
				$link .= '&port='. $port;
			}
			$link .= '&amount=$';

			$pos_default['link'] = $link;

			\dash\data::pcPosLink($pos_default);
		}

	}
}
?>