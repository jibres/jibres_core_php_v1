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

		foreach ($sql_query as $sql_file)
		{
			$load_file = \dash\file::read($sql_file);
			if(is_string($load_file) && $load_file)
			{
				$load_file = str_replace('jibres_XXXXXXX', $customer_db_name, $load_file);
				$is_ok = self::run_query($load_file);
				if(!$is_ok)
				{
					\dash\log::set('errorInstallCustomerDb', ['db_file' => $sql_file]);
					break;
				}
			}
		}

		if($is_ok)
		{
			self::inner_query($customer_db_name, $_args);
		}

		return $is_ok;
	}


	public static function addr()
	{
		return root. 'includes/database/customer';
	}


	private static function run_query($_query)
	{
		$result = \dash\db::query($_query, true, ['multi_query' => true]);
		return $result;
	}


	private static function inner_query($_db_name, $_args)
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

		self::insert_customer_user($_db_name, $set);
	}


	private static function insert_customer_user($_db_name, $_set)
	{
		$query = "INSERT INTO `$_db_name`.`users` SET $_set";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>