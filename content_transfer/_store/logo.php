<?php
namespace content_transfer\_store;

class logo
{
	public static function run()
	{
		\content_transfer\say::info('Transfer store logo ...');
		self::store_logo();
	}


	private static function store_logo()
	{
		$query = " SELECT * FROM stores WHERE stores.logo IS NOT NULL";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{

			$check_logo = "SELECT * FROM setting WHERE setting.cat = 'store_setting' AND setting.key = 'logo' LIMIT 1";
			$check_logo_record = \dash\db::get($check_logo, null, true, 'local', ['database' => 'jibres_'. $value['new_id']]);
			if(!isset($check_logo_record['id']))
			{
				$insert_logo =
				[

					'cat'   => 'store_setting',
					'key'   => 'logo',
					'value' => $value['logo'],
				];

				$set = \dash\db\config::make_set($insert_logo, ['type' => 'insert']);

				$query_insert_logo = " INSERT INTO setting SET $set ";

				\dash\db::query($query_insert_logo, 'local', ['database' => 'jibres_'. $value['new_id']]);

			}
		}
	}
}
?>