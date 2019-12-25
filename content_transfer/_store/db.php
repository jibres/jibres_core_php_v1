<?php
namespace content_transfer\_store;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Start convert stores ...');
		self::convert_store();
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


}
?>