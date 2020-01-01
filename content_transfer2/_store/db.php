<?php
namespace content_transfer\_store;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Transfer stores ...');
		self::convert_store();

		\content_transfer\say::info('Transfer stores data ...');
		self::convert_store_data();

		\content_transfer\say::info('Transfer stores plan ...');
		self::transfer_store_plan();
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





	private static function transfer_store_plan()
	{
		$query =
		"
			INSERT INTO jibres.store_plan
			(
				`id`,
				`store_id`,
				`user_id`,
				`plan`,
				`start`,
				`end`,
				`type`,
				`description`,
				`status`,
				`price`,
				`discount`,
				`promo`,
				`period`,
				`expireplan`,
				`datecreated`,
				`datemodified`
			)
			SELECT
				jibres_transfer.planhistory.id,
				(SELECT jibres_transfer.stores.new_id FROM jibres_transfer.stores WHERE jibres_transfer.stores.id = jibres_transfer.planhistory.store_id LIMIT 1),
				jibres_transfer.planhistory.creator,
				jibres_transfer.planhistory.plan,
				jibres_transfer.planhistory.start,
				jibres_transfer.planhistory.end,
				jibres_transfer.planhistory.type,
				jibres_transfer.planhistory.desc,
				jibres_transfer.planhistory.status,
				jibres_transfer.planhistory.price,
				jibres_transfer.planhistory.discount,
				jibres_transfer.planhistory.promo,
				jibres_transfer.planhistory.period,
				jibres_transfer.planhistory.expireplan,
				jibres_transfer.planhistory.datecreated,
				jibres_transfer.planhistory.datemodified
			FROM
				jibres_transfer.planhistory
			WHERE 1
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);

	}


}
?>