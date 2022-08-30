<?php
namespace content_sudo\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		self::find_application();
	}




	private static function find_application()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		$file_error = [];
		$duplicate = 0;
		$run = 0;
		$business_have_inquery = [];

		\dash\code::time_limit(0);
        var_dump($list);
		$store_have_application = [];
		foreach ($list as $key => $value)
		{
			$query    = "SELECT COUNT(*) AS `count` FROM products where products.price > 0 AND products.finalprice <= 0 ";

			$store_id = $value['id'];
			$dbname   = \dash\engine\store::make_database_name($store_id);
			$resutl   = \dash\pdo::get($query, [], 'count', true, $value['fuel'], ['database' => $dbname]);

			if($resutl)
			{
				$business_have_inquery[$store_id] = $resutl;
			}

			\dash\pdo::close();
		}

		\dash\log::to_supervisor('Check product price: '. json_encode($business_have_inquery));

		var_dump($business_have_inquery);
		var_dump('ok');
		exit();
	}



}
?>