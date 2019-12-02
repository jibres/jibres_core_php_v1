<?php
namespace lib\app\store;


class db
{
	public static function create($_store_id, $_args = [])
	{

		$addr             = self::addr();
		$sql_query        = glob($addr. '/*');
		$is_ok            = false;
		$customer_db_name = 'jibres_'. $_store_id;

		if(\dash\url::isLocal())
		{
			$customer_db_name = 'jibresLocal_'. $_store_id;
		}


		// in first query we need to connect to mysql database
		// and the create the customer database
		// and then connect to customer database
		$fuel = $_args['fuel'];

		$create_database = self::create_database_customer($fuel, $customer_db_name);
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

		return $is_ok;
	}


	private static function create_database_customer($_fuel, $_customer_database)
	{
		$query = "CREATE DATABASE IF NOT EXISTS `$_customer_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
		$result = \dash\db::query($query, ['fuel' => $_fuel, 'database' => 'mysql']);
		return $result;
	}


	private static function addr()
	{
		return root. 'includes/database/customer';
	}


	private static function run_query($_query, $_fuel, $_database)
	{
		$result = \dash\db::query($_query, ['fuel' => $_fuel, 'database' => $_database], ['multi_query' => true]);
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

		$set = \dash\db\config::make_set($set);


		$query = "INSERT INTO `$_database`.`users` SET $set";
		$result = \dash\db::query($query, ['fuel' => $_fuel, 'database' => $_database]);

		$set_setting = [];

		$set_setting[] = self::make_setting_record('store_setting', 'owner', 			$_args['owner']);
		$set_setting[] = self::make_setting_record('store_setting', 'title', 			$_args['title']);
		$set_setting[] = self::make_setting_record('store_setting', 'subdomain', 		$_args['subdomain']);
		$set_setting[] = self::make_setting_record('store_setting', 'plan', 			$_args['plan']);
		$set_setting[] = self::make_setting_record('store_setting', 'startplan', 		$_args['startplan']);
		$set_setting[] = self::make_setting_record('store_setting', 'expireplan',  		$_args['expireplan']);

		$set_setting = \dash\db\config::make_multi_insert($set_setting);

		$query = "INSERT INTO `$_database`.`setting` $set_setting";
		$result = \dash\db::query($query, ['fuel' => $_fuel, 'database' => $_database]);
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
}
?>