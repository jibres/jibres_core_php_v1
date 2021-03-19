<?php
namespace lib\app\store;


class changefuel
{

	private static function addr($_store_id)
	{
		$addr = YARD. 'jibres_temp/transferfuel/';
		$addr .= $_store_id. '.conf';
		return $addr;
	}


	public static function request($_store_id, $_new_fuel)
	{
		$store_id = \dash\validate::id($_store_id);
		if(!$store_id)
		{
			\dash\notif::error(T_("Invalid store id"));
			return false;
		}

		$trust_new_fuel = null;

		$server_list = \dash\setting\servername::database();

		foreach ($server_list as $key => $value)
		{
			if(!$trust_new_fuel)
			{
				if(isset($value['fuelname']) && $value['fuelname'] === $_new_fuel)
				{
					$trust_new_fuel = $value['fuelname'];
				}
			}
		}

		if(!$trust_new_fuel)
		{
			\dash\notif::error(T_("Invalid fuel"));
			return false;
		}

		$store_detail = \lib\db\store\get::by_id($store_id);
		if(!$store_detail)
		{
			\dash\notif::error(T_("Store detail not found"));
			return false;
		}

		if(!isset($store_detail['fuel']))
		{
			\dash\notif::error(T_("Store fuel not found"));
			return false;
		}

		if($store_detail['fuel'] == $trust_new_fuel)
		{
			\dash\notif::error(T_("No change in business fuel"));
			return false;
		}


		$addr = self::addr($store_id);

		if(is_file($addr))
		{
			\dash\notif::error(T_("Duplidate transfer request"));
			return false;
		}

		if(!is_dir(dirname($addr)))
		{
			\dash\file::makeDir(dirname($addr));
		}

		$json = ['new_fuel'  => $trust_new_fuel];
		$json = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		\dash\file::write($addr, $json);

		\dash\notif::ok(T_("Transfer request was saved"));



		return true;
	}

	public static function change()
	{
		$store_id = \dash\validate::id($_store_id);
		if(!$store_id)
		{
			return false;
		}

		\lib\db\store\update::set_enable($store_id);

		\lib\store::reset_cache($store_id);

		\dash\notif::ok(T_("Store was enabled"));
		return true;
	}

}
?>