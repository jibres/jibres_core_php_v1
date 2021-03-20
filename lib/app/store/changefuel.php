<?php
namespace lib\app\store;


class changefuel
{
	/**
	 * Current config file addr for each request
	 *
	 * @var        <type>
	 */
	private static $config_file_addr = null;


	/**
	 * Transfer config addr
	 *
	 * @param      string  $_filename  The filename
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function addr($_mode = null, $_filename = null)
	{
		$addr = YARD. 'jibres_temp/transferfuel/';

		if($_mode)
		{
			$addr .= $_mode . '/';
		}

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


		$addr = self::addr('queue', $store_id);

		if(is_file($addr))
		{
			\dash\notif::error(T_("Duplidate transfer request"));
			return false;
		}

		if(!is_dir(dirname($addr)))
		{
			\dash\file::makeDir(dirname($addr), null, true);
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
		return; // need to check in next year :)

		// system is busy
		if(self::is_busy())
		{
			return;
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


	/**
	 * Check any store in queue
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function any_queue()
	{
		$addr = self::addr('queue');

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


	/**
	 * Starts transfer business fuel
	 *
	 * @param      <type>   $_detail  The detail
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function start_transfer($_detail)
	{
		self::log(str_repeat('+', 50));
		self::log('Start');

		if(!isset($_detail['file_addr']))
		{
			self::log('file_addr_error', $_detail);
			return false;
		}

		$config_file_addr = $_detail['file_addr'];
		self::$config_file_addr = $config_file_addr;

		if(!isset($_detail['new_fuel']))
		{
			self::end_log('invalid_new_fuel', $_detail);
			return false;
		}

		if(!isset($_detail['store_id']))
		{
			self::end_log('invalid_store_id', $_detail);
			return false;
		}

		$new_fuel = $_detail['new_fuel'];
		$store_id = $_detail['store_id'];

		// -----------------------------------------------
		// load store detail
		// check current fuel and new fuel is not equal
		// test current fuel connection
		// test new fuel connection
		// check business database is not exist in new fuel
		// set business status on tranfer mode
		// backup database from old fuel
		// import database to new fuel
		// test count table is equal by old count table
		// update fuel value in db record
		// rename old database to *_transfered. (need fix)
		// unlock store
		// -----------------------------------------------

		// load store setting
		$store_detail = \lib\db\store\get::by_id($store_id);
		if(!$store_detail)
		{
			self::end_log('store detail not found for transfer', $_detail);
			return false;
		}

		if(!isset($store_detail['fuel']))
		{
			self::end_log('store fuel not found for transfer', $store_detail);
			return false;
		}

		$current_fuel = $store_detail['fuel'];

		// check current fuel and new fuel is not equal
		if($current_fuel === $new_fuel)
		{
			self::end_log('Current fuel is equal with new fuel', $store_detail);
			return false;
		}

		$db_name = \dash\engine\store::make_database_name($store_id);

		// test current fuel connection
		$current_fuel_connection = \dash\db\mysql\tools\info::test_connection($current_fuel, $db_name);

		if(!$current_fuel_connection)
		{
			self::end_log('Current fuel connection if failed', $store_detail);
			return false;
		}

		// test new fuel connection
		$new_fuel_connection = \dash\db\mysql\tools\info::test_connection($new_fuel);

		if(!$new_fuel_connection)
		{
			self::end_log('New fuel connection if failed', $store_detail);
			return false;
		}

		// check business database is not exist in new fuel
		$check_database_exist = \dash\db\mysql\tools\info::database_exist($new_fuel, $db_name);

		if($check_database_exist)
		{
			self::end_log('Database exists in new fuel', $store_detail);
			return false;
		}

		$current_table_count = \dash\db\mysql\tools\info::count_table($current_fuel, $db_name);
		if(!$current_table_count)
		{
			self::end_log('Count table is null!', $store_detail);
			return false;
		}

		$current_last_user_id = \lib\db\users\get::last_user_id_fuel_db_name($current_fuel, $db_name);



		// set business status on tranfer mode
		\lib\db\store\update::set_transfer($store_id);
		self::log('Change business status on tranfer');

		$current_fuel_detail = \dash\engine\fuel::get($current_fuel);

		// backup database from old fuel
		$backup_addr = self::addr('backup');
		$backup_addr .= $store_id. '.sql';

		$backup = \dash\engine\backup\database::backup_cmd($current_fuel_detail, $db_name);
		$backup .= ' > '. $backup_addr;

		self::log('Start backup cmd');
		self::log($backup);
		$sh = exec($backup);
		self::log('Backup complete');

		// import database to new fuel and temp database
		$new_fuel_detail = \dash\engine\fuel::get($new_fuel);

		$import = \dash\engine\backup\database::import_cmd($new_fuel_detail, $db_name);
		$import .= ' < '. $backup_addr;

		self::log('Start import backup');
		self::log($import);
		$sh = exec($import);
		self::log('import complete');


		// test count table is equal by old count table
		$new_table_count = \dash\db\mysql\tools\info::count_table($new_fuel, $db_name);
		if(!$new_table_count)
		{
			self::end_log('Count table is null!', $store_detail);
			return false;
		}

		if(floatval($current_table_count) !== floatval($new_table_count))
		{
			self::end_log('Old count table and new count table is not equal!', $store_detail);
			return false;
		}

		$new_last_user_id = \lib\db\users\get::last_user_id_fuel_db_name($new_fuel, $db_name);

		if($current_last_user_id != $new_last_user_id)
		{
			self::end_log('Last user id not match!', [$current_last_user_id, $new_last_user_id]);
			return false;
		}

		// update fuel value in db record
		\lib\db\store\update::new_fuel($store_id, $new_fuel);
		self::log('Change business fuel record');

		// rename old database to *_transfered
		self::rename_database($current_fuel, $db_name, $db_name. '_transfered');
		self::log('Rename old business database');

		// unlock store
		\lib\db\store\update::set_enable($store_id);
		self::log('Enable business status');

		self::log('Finish');

		self::log(str_repeat('-', 50));

		return true;
	}


	private static function rename_database($_fuel, $_db_name, $_new_db_name)
	{
		self::log('rename database');
		$fuel_detail = \dash\engine\fuel::get($_fuel);

		// backup database from old fuel
		$rename_addr = self::addr('rename');
		$rename_addr .= $_db_name. '.sql';

		$rename = \dash\engine\backup\database::backup_cmd($fuel_detail, $_db_name);
		$rename .= ' > '. $rename_addr;

		$rename = str_replace('--add-drop-table', '--no-create-db', $rename);
		self::log($rename);
		exec($backup);

		$create_new_database = \dash\db\mysql\tools\info::create_database($_fuel, $_new_db_name);
		$import = \dash\engine\backup\database::import_cmd($fuel_detail, $_new_db_name);
		$import .= ' < '. $rename_addr;

		self::log($import);
		exec($import);

		// drop database
		$drop_database = \dash\db\mysql\tools\info::drop_database($_fuel, $db_name);
		self::log('drop old database');


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


	/**
	 * End log. save log and remove config file addr
	 */
	private static function end_log()
	{
		self::log(...func_get_args());

		self::log(str_repeat('<', 50));

		if(self::$config_file_addr)
		{
			\dash\file::delete(self::$config_file_addr);
		}
	}


	/**
	 * Save log history
	 *
	 * @param      <type>  $_text    The text
	 * @param      <type>  $_detail  The detail
	 */
	private static function log($_text, $_detail = null)
	{
		$log = date("Y-m-d H:i:s");
		$log .= ' '. $_text;
		if($_detail)
		{
			if(is_array($_detail))
			{
				unset($_detail['file_addr']);
				$_detail = json_encode($_detail, JSON_UNESCAPED_UNICODE);
			}

			if(is_string($_detail))
			{
				$log .= ' - '. $_detail;
			}
		}

		\dash\log::file($log, 'transferfuel.log', 'transferfuel', true);
	}


}
?>