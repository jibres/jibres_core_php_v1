<?php
namespace lib\app\store;


class db
{
	public static function create($_store_id)
	{

		$addr      = self::addr();
		$sql_query = glob($addr. '/*');
		$is_ok     = false;

		foreach ($sql_query as $sql_file)
		{
			$load_file = \dash\file::read($sql_file);
			if(is_string($load_file) && $load_file)
			{
				$load_file = str_replace('jibres_XXXXXXX', 'jibres_'. $_store_id, $load_file);
				$is_ok = self::run_query($load_file);
				if(!$is_ok)
				{
					\dash\log::set('errorInstallCustomerDb', ['db_file' => $sql_file]);
					break;
				}
			}
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
}
?>