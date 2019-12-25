<?php
namespace content_transfer\_store;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Start convert stores ...');
		self::convert_store();

		self::convert_store_data();
	}


	private static function convert_store()
	{
		$query = "SELECT * FROM stores";
		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$new_store =
			[
				'subdomain'    => $value['slug'],
				'fuel'         => 'local',
				'creator'      => $value['creator'],
				'datecreated'  => $value['datecreated'],
				'datemodified' => $value['datemodified'],
			];

			$store_id = null;

			$check_query = "SELECT * FROM jibres.store WHERE store.subdomain = '$value[slug]' LIMIT 1";
			$check       = \dash\db::get($check_query, null, true, 'local', ['database' => 'jibres']);

			if(isset($check['id']))
			{
				$store_id = $check['id'];
			}
			else
			{
				$set = \dash\db\config::make_set($new_store, ['type' => 'insert']);

				$query = " INSERT INTO jibres.store SET $set ";

				$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres']);

				if($inserr_new_store)
				{
					$store_id = \dash\db::insert_id();
				}
			}

			if(!$store_id)
			{
				\content_transfer\say::end('Can not add store! '.  json_encode($new_store, JSON_UNESCAPED_UNICODE));
			}

			$query = "UPDATE stores SET stores.new_id = $store_id WHERE stores.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}



	private static function convert_store_data()
	{
		$query = "SELECT * FROM stores";
		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$new_store =
			[
				'id'            => $value['new_id'],
				'title'         => $value['name'],
				'owner'         => $value['creator'],
				'description'   => $value['desc'],
				'lang'          => null,
				'unit'          => null,
				'country'       => null,
				'domain1'       => null,
				'domain2'       => null,
				'domain3'       => null,
				'status'        => $value['status'],
				'logo'          => $value['logo'],
				'plan'          => $value['plan'],
				'startplan'     => $value['startplan'],
				'expireplan'    => $value['expireplan'],
				'lastactivity'  => $value['datemodified'],
				'dbversion'     => null,
				'dbversiondate' => null,
				'datecreated'   => $value['datecreated'],
				'datemodified'  => $value['datemodified'],
			];

			$inserr_new_store_data = null;

			$check_query = "SELECT * FROM jibres.store_data WHERE store_data.id = '$value[new_id]' LIMIT 1";
			$check       = \dash\db::get($check_query, null, true, 'local', ['database' => 'jibres']);

			if(isset($check['id']))
			{
				$inserr_new_store_data = $check['id'];
			}
			else
			{
				$set = \dash\db\config::make_set($new_store, ['type' => 'insert']);

				$query = " INSERT INTO jibres.store_data SET $set ";

				$inserr_new_store_data = \dash\db::query($query, 'local', ['database' => 'jibres']);

			}

			if(!$inserr_new_store_data)
			{
				\content_transfer\say::end('Can not add store data! '.  json_encode($new_store, JSON_UNESCAPED_UNICODE));
			}
		}
	}


}
?>