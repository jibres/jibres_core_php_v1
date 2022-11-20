<?php

namespace content_sudo\fix\cdn;

class controller
{

	public static function routing()
	{

		$list = \lib\db\store\get::all_store_fuel_detail();


		$business_have_s3_file = [];

		\dash\code::time_limit(0);

		$store_have_application = [];
		foreach ($list as $key => $value)
		{
			$query    = "SELECT COUNT(*) AS `count` FROM files where files.path like '%arvanstorage.com%'  ";

			$store_id = $value['id'];
			$dbname   = \dash\engine\store::make_database_name($store_id);
			$resutl   = \dash\pdo::get($query, [], 'count', true, $value['fuel'], ['database' => $dbname]);

			// if($resutl)
			// {
			// 	$query    = "SELECT products.id AS `count` FROM products where products.price > 0 AND products.finalprice <= 0 ";
			//
			// 	$ids   = \dash\pdo::get($query, [], 'count', false, $value['fuel'], ['database' => $dbname]);
			//
			// }
			$business_have_s3_file[$store_id] = $resutl;

			\dash\pdo::close();
		}

		\dash\log::to_supervisor('ArvanStorageFile: '. json_encode($business_have_s3_file));
		\dash\log::to_supervisor('TotalFileOnArvanStorageS3: '. array_sum($business_have_s3_file));

		var_dump(array_sum($business_have_s3_file));
		var_dump($business_have_s3_file);
		var_dump('ok');
		exit();
	}

}

?>