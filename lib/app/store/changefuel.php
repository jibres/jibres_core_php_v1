<?php
namespace lib\app\store;


class changefuel
{

	/**
	 * Transfer config addr
	 *
	 * @param      string  $_filename  The filename
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function addr($_filename = null)
	{
		$addr = YARD. 'jibres_temp/transferfuel/';

		if($_filename)
		{
			$addr .= $_filename. '.conf';
		}

		return $addr;
	}


	/**
	 * Save request of new fuel transfer
	 *
	 * @param      <type>   $_store_id  The store identifier
	 * @param      <type>   $_new_fuel  The new fuel
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
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

		$json =
		[
			'new_fuel' => $trust_new_fuel,
			'store_id' => $store_id,
		];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		\dash\file::write($addr, $json);

		\dash\notif::ok(T_("Transfer request was saved"));
		return true;
	}


	/**
	 * Run transfer
	 * By cronjob every min
	 */
	public static function run()
	{
		// system is busy
		if(self::is_busy())
		{
			// return;
		}

		$store_conf = self::any_queue();

		// nothing in queue
		if(!$store_conf)
		{
			return;
		}

		self::set_busy();


		self::start_transfer($store_conf);


		self::set_free();

	}


	private static function any_queue()
	{
		$addr = self::addr();

		$list = glob($addr. '*.conf', GLOB_NOSORT);

		if($list && isset($list[0]))
		{
			$queue = $list[0];

			$detail = \dash\file::read($queue);

			$detail = json_decode($detail, true);

			if(!is_array($detail))
			{
				\dash\file::delete($queue);
				return [];
			}

			$detail['file_addr'] = $queue;

			return $detail;
		}

		return false;
	}



	private static function start_transfer($_detail)
	{
		if(!isset($_detail['file_addr']))
		{
			return false;
		}

		$config_file_addr = $_detail['file_addr'];

		if(!isset($_detail['new_fuel']))
		{
			// invalid json. Need to remove file
			\dash\file::delete($config_file_addr);
			return false;
		}

		if(!isset($_detail['store_id']))
		{
			// invalid json. Need to remove file
			\dash\file::delete($config_file_addr);
			return false;
		}

		$new_fuel = $_detail['new_fuel'];
		$store_id = $_detail['store_id'];

		// load store detail
		// check current fuel and new fuel is not equal
		// test current fuel connection
		// test new fuel connection
		// set business status on tranfer mode
		// backup database from old fuel
		// import database to new fuel
		// update fuel value in db record
		// rename old database to *_transfered
		// unlock store


		var_dump($_detail);exit();
	}


	/**
	 * Determines if busy.
	 *
	 * @return     boolean  True if busy, False otherwise.
	 */
	private static function is_busy()
	{
		return self::busy(null);
	}


	/**
	 * Sets the transfer is busy.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function set_busy()
	{
		return self::busy(true);
	}


	/**
	 * Sets the free.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function set_free()
	{
		return self::busy(false);
	}


	/**
	 * Manaage busy file
	 *
	 * @param      boolean  $_action  The action
	 *
	 * @return     <type>   ( description_of_the_return_value )
	 */
	private static function busy($_action = null)
	{
		$addr = self::addr();

		$addr .= 'transfer_is_busy.log';

		// check is busye
		if($_action === null)
		{
			return is_file($addr);
		}

		if($_action === false)
		{
			\dash\file::delete($addr);
		}

		if($_action === true)
		{
			\dash\file::write($addr, date("Y-m-d H:i:s"));
		}
	}
}
?>