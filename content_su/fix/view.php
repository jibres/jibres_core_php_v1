<?php
namespace content_su\fix;


class view
{
	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		self::fix_menu();

	}



	private static function fix_menu()
	{
		$list = \lib\db\store\get::all_store_fuel_detail();

		$setting = [];

		foreach ($list as $key => $value)
		{
			$query = "SELECT * FROM setting WHERE setting.cat = 'menu' ";
			$dbname = \dash\engine\store::make_database_name($value['id']);
			$resutl = \dash\db::get($query, null, false, $value['fuel'], ['database' => $dbname]);
			if($resutl)
			{
				foreach ($resutl as $one_old_menu)
				{
					if(isset($one_old_menu['value']) && $one_old_menu['value'])
					{
						$json = json_decode($one_old_menu['value'], true);
						if(!is_array($json))
						{
							var_dump('is not array');
							var_dump($one_old_menu);
							var_dump($value);
							var_dump($resutl);
							continue;
						}

						if(!isset($json['title']) && !isset($json['list']) || (!is_array(a($json, 'list'))))
						{
							var_dump('have not title or list');
							var_dump($one_old_menu);
							var_dump($value);
							var_dump($resutl);
							continue;
						}

						$master_menu_title = $json['title'];

						$check_not_duplicate = " SELECT *  FROM menu WHERE menu.title = '$json[title]' AND menu.parent1 IS NULL LIMIT 1 ";
						$check_not_duplicate = \dash\db::get($check_not_duplicate, null, true, $value['fuel'], ['database' => $dbname]);
						if($check_not_duplicate)
						{
							var_dump('duplicate menu !!!!! Do not run this url again :/');
							continue;
						}

						$insert_master_menu = " INSERT INTO menu SET menu.title = '$json[title]' ";
						$resutl = \dash\db::query($insert_master_menu, $value['fuel'], ['database' => $dbname]);
						$master_id = \dash\db::insert_id();

						if(!$master_id)
						{
							var_dump('can not add master menu');
							var_dump($one_old_menu);
							var_dump($value);
							var_dump($resutl);
							continue;
						}

						$multi_insert = [];

						foreach ($json['list'] as $v)
						{
							$multi_insert[] =
							[
								'title'   => a($v, 'title'),
								'url'     => a($v, 'url'),
								'target'  => a($v, 'target') ? 'blank' : null,
								'sort'    => intval(a($v, 'sort')) + 1,
								'parent1' => $master_id,
								'pointer' => 'other',
							];
						}

						if(!empty($multi_insert))
						{
							$make_multi_insert_set = \dash\db\config::make_multi_insert($multi_insert);

							$insert_master_menu_result = \dash\db::query(" INSERT INTO menu $make_multi_insert_set ", $value['fuel'], ['database' => $dbname]);

							if(!$insert_master_menu_result)
							{
								var_dump('can not add master menu');
								var_dump($one_old_menu);
								var_dump($value);
								var_dump($resutl);
								continue;
							}
						}


						$load_usage = \dash\db::query("UPDATE setting SET setting.value = '$master_id' WHERE setting.value = '$one_old_menu[key]' ", $value['fuel'], ['database' => $dbname]);



						// check menu position
						// var_dump($multi_insert);
						// var_dump($json);
					}
				}
				// var_dump($value);
				// var_dump($resutl);
			}
		}

		var_dump('all menu converted to new version');exit();
	}
}
?>