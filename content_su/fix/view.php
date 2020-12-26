<?php
namespace content_su\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

	}



	private static function setting_news_fix()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		foreach ($list as $key => $value)
		{
			$query = "SELECT * FROM setting WHERE setting.key LIKE 'body_line_news' ";
			$dbname = \dash\engine\store::make_database_name($value['id']);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);
			if($resutl)
			{
			var_dump($value);
				var_dump($resutl);
			}
		}
		var_dump($list
		);exit();
	}
}
?>