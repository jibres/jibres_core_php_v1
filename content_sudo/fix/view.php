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

		\dash\code::time_limit(0);

		$store_have_application = [];
		foreach ($list as $key => $value)
		{
			$query = "	SELECT * FROM setting where setting.platform = 'android' and setting.key in ('myket', 'cafebazar', 'googleplay') AND setting.value is not null ";
			$store_id = $value['id'];
			$dbname = \dash\engine\store::make_database_name($store_id);
			$resutl = \dash\pdo::get($query, [], null, false, $value['fuel'], ['database' => $dbname]);

			if($resutl)
			{
				$store_have_application[] = 'https://jibres.ir/'.\dash\store_coding::encode($value['id']).'/a/android/download#'.$value['subdomain'];
			}

			\dash\pdo::close();
		}

		\dash\log::to_supervisor('store with application: '. implode("\n". , $store_have_application));

		var_dump($store_have_application);
		var_dump('ok');
		exit();
	}



}
?>