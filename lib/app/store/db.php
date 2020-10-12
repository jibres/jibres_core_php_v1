<?php
namespace lib\app\store;


class db
{
	public static function create($_store_id, $_args = [])
	{

		$addr             = self::addr();
		$sql_query        = glob($addr. '/*');
		$is_ok            = false;

		$customer_db_name = \dash\engine\store::make_database_name($_store_id);


		// in first query we need to connect to mysql database
		// and the create the customer database
		// and then connect to customer database
		$fuel = $_args['fuel'];

		$create_database = \lib\db\store\create::database_customer($fuel, $customer_db_name);
		if(!$create_database)
		{
			\dash\log::set('errorInstallCustomerDbCreateDatabase', ['args' => $_args]);
			return false;
		}


		foreach ($sql_query as $sql_file)
		{
			$load_file = \dash\file::read($sql_file);
			if(is_string($load_file) && $load_file)
			{
				$load_file = str_replace('jibres_XXXXXXX', $customer_db_name, $load_file);
				$is_ok = self::run_query($load_file, $fuel, $customer_db_name);

				if(!$is_ok)
				{
					\dash\log::set('errorInstallCustomerDb', ['db_file' => $sql_file, 'args' => $_args]);
					break;
				}
			}
		}

		if($is_ok)
		{
			self::inner_query($_args, $fuel, $customer_db_name);
		}

		$upgrade_addr = self::upgrade_addr();
		$update_sql_query = glob($upgrade_addr . '/*');

		foreach ($update_sql_query as $sql_file)
		{
			$load_file = \dash\file::read($sql_file);
			if(is_string($load_file) && $load_file)
			{
				$load_file = str_replace('jibres_XXXXXXX', $customer_db_name, $load_file);
				$is_ok = self::run_query($load_file, $fuel, $customer_db_name);

				if(!$is_ok)
				{
					\dash\log::set('errorUpgradeCustomerDb', ['db_file' => $sql_file, 'args' => $_args]);
					break;
				}
			}
		}

		if($is_ok)
		{
			self::set_last_db_version($update_sql_query, $_store_id);
			\lib\app\store\config::init($_store_id, $fuel, $customer_db_name, $_args);
		}


		return $is_ok;
	}





	private static function addr()
	{
		return root. 'includes/database/customer';
	}


	private static function upgrade_addr()
	{
		return root. 'includes/database/upgrade/store';
	}


	private static function run_query($_query, $_fuel, $_database)
	{
		$result = \dash\db::query($_query, $_fuel, ['database' => $_database, 'multi_query' => true]);
		return $result;
	}


	private static function inner_query($_args, $_fuel, $_database)
	{
		// insert current user to customer database
		$set                   = [];
		$set['status']         = 'active';
		$set['permission']     = 'admin';
		$set['jibres_user_id'] = $_args['creator'];
		$set['mobile']         = $_args['mobile'];
		$set['displayname']    = $_args['displayname'];
		$set['gender']         = $_args['gender'];
		$set['avatar']         = $_args['avatar'];
		$set['birthday']       = $_args['birthday'];
		$set['marital']        = $_args['marital'];

		\dash\db\users\insert::jibres_customer_users_insert($_database, $_fuel, $set);


		$set_setting = [];

		$set_setting[] = self::make_setting_record('store_setting', 'owner', 			$_args['owner']);
		$set_setting[] = self::make_setting_record('store_setting', 'title', 			$_args['title']);
		$set_setting[] = self::make_setting_record('store_setting', 'subdomain', 		$_args['subdomain']);
		$set_setting[] = self::make_setting_record('store_setting', 'plan', 			$_args['plan']);
		$set_setting[] = self::make_setting_record('store_setting', 'startplan', 		$_args['startplan']);
		$set_setting[] = self::make_setting_record('store_setting', 'expireplan',  		$_args['expireplan']);

		\lib\db\setting\insert::insert_fuel($set_setting, $_fuel, $_database);

	}


	private static function make_setting_record($_cat = null, $_key = null, $_value = null, $_lang = null)
	{
		return
		[
			'lang'  => $_lang,
			'cat'   => $_cat,
			'key'   => $_key,
			'value' => $_value,
		];
	}


	private static function set_last_db_version($_updates, $_store_id)
	{
		$last_file = end($_updates);
		if(is_string($last_file))
		{
			if(preg_match("/v\.(\d+\.\d+\.\d+)\_(.*)$/", $last_file, $split))
			{
				$last_db_version = $split[1];
				$query = \lib\db\store\get_string::update_db_version($last_db_version, date("Y-m-d H:i:s"), $_store_id);
				$result = \dash\db::query($query, 'master');

			}
		}
	}
}
?>