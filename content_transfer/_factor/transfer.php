<?php
namespace content_transfer\_factor;

class transfer
{


	public static function run()
	{

		$query =
		"

			SELECT
				count(*)
			FROM
				factors
			INNER JOIN userstores ON factors.seller = userstores.id
			WHERE
				userstores.store_id != factors.store_id
		";

		$query = [];
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_price` bigint(20) unsigned NULL DEFAULT NULL AFTER `price`;";
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_count` int(10) unsigned NULL DEFAULT NULL AFTER `count`;";
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_discount` bigint(20) unsigned NULL DEFAULT NULL AFTER `discount`;";
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_sum` bigint(20) unsigned NULL DEFAULT NULL AFTER `sum`;";
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_vat` int(10) unsigned NULL DEFAULT NULL AFTER `vat`;";

		$query[] = "UPDATE factordetails SET factordetails.new_price = factordetails.price * 1000 ;";
		$query[] = "UPDATE factordetails SET factordetails.new_count = factordetails.count * 100 ;";
		$query[] = "UPDATE factordetails SET factordetails.new_discount = factordetails.discount * 1000 ;";

		$query[] = "UPDATE factordetails SET factordetails.new_sum = (factordetails.new_price - factordetails.new_discount) * factordetails.new_count ;";


		$query[] = "ALTER TABLE `factors` ADD  `new_qty` int(10) UNSIGNED DEFAULT NULL AFTER `qty`;";
		$query[] = "ALTER TABLE `factors` ADD  `new_item` bigint(20) UNSIGNED DEFAULT NULL AFTER `item`;";
		$query[] = "ALTER TABLE `factors` ADD  `new_detailsum` bigint(20) UNSIGNED DEFAULT NULL AFTER `detailsum`;";
		$query[] = "ALTER TABLE `factors` ADD  `new_detaildiscount` bigint(20) DEFAULT NULL AFTER `detaildiscount`;";
		$query[] = "ALTER TABLE `factors` ADD  `new_detailtotalsum` bigint(20) UNSIGNED DEFAULT NULL AFTER `detailtotalsum`;";
		$query[] = "ALTER TABLE `factors` ADD  `new_discount` int(10) DEFAULT NULL AFTER `discount`;";
		$query[] = "ALTER TABLE `factors` ADD  `new_sum` bigint(20) UNSIGNED DEFAULT NULL AFTER `sum`;";

		$query[] = "UPDATE factors SET factors.new_detailsum = (SELECT SUM(factordetails.new_price * factordetails.new_count) FROM factordetails WHERE factordetails.factor_id = factors.id ) ;";
		$query[] = "UPDATE factors SET factors.new_detaildiscount = (SELECT SUM(factordetails.new_discount * factordetails.new_count) FROM factordetails WHERE factordetails.factor_id = factors.id ) ;";
		$query[] = "UPDATE factors SET factors.new_qty = (SELECT SUM(factordetails.new_count) FROM factordetails WHERE factordetails.factor_id = factors.id ) ;";

		$query[] = "UPDATE factors SET factors.new_detailtotalsum = (SELECT SUM((factordetails.new_price * factordetails.new_count) - (factordetails.new_discount * factordetails.new_count)) FROM factordetails WHERE factordetails.factor_id = factors.id ) ;";

		j($query);
		j('fff');
		\content_transfer\say::info('Transfer factors ...');

	}


	private static function factors()
	{
		$query =
		"
			SELECT

				factors.*,
				factors.id AS `factor_id`,
				stores.new_id AS `new_store_id`,
				(SELECT userstores.new_id FROM userstores WHERE userstores.id = factors.seller and userstores.store_id = factors.store_id LIMIT 1 ) AS `new_seller_id`,
				IF(
					factors.customer IS NOT NULL ,
					(SELECT userstores.new_id FROM userstores WHERE userstores.id = factors.customer and userstores.store_id = factors.store_id LIMIT 1 ),
					 NULL
				  ) AS `new_customer_id`

			FROM factors

			INNER JOIN stores ON stores.id = factors.store_id

			WHERE factors.new_id IS NULL
			LIMIT 2000

		";


		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		if(!$result)
		{
			self::$continue = false;
		}

		$i = 0;
		foreach ($result as $key => $value)
		{
			$i++;
			self::$count_all++;

			$factor_detail_query =
			"
				SELECT
					factordetails.*,
					products.new_id AS `product_new_id`
				FROM
					factordetails
				INNER JOIN products ON products.id = factordetails.product_id
				WHERE
					factordetails.factor_id = $value[factor_id]
			";

			$factor_detail = \dash\db::get($factor_detail_query, null, false, 'local', ['database' => 'jibres_transfer']);

			if(!$factor_detail)
			{
				\content_transfer\say::error('Facordetails record is empty!'. ' '. json_encode($value, JSON_UNESCAPED_UNICODE));
				continue;
			}

			$qty            = 0;

			$detailsum      = 0;
			$detaildiscount = 0;
			$detailtotalsum = 0;

			$insert_new_factor_detail = [];

			foreach ($factor_detail as  $factor_record)
			{
				$price    = \lib\price::up($factor_record['price']);

				$count    = \lib\number::up($factor_record['count']);

				$discount = \lib\price::up($factor_record['discount']);

				$mySum = $price * $count;

				$detailsum      += $mySum;
				$detaildiscount += ($discount * $count);
				$detailtotalsum += $mySum - ($discount * $count);
				$qty            += $count;

				$insert_new_factor_detail[] =
				[
					'factor_id'  => null,
					'product_id' => $factor_record['product_new_id'],
					'price'      => $price,
					'count'      => $count,
					'discount'   => $discount,
					'sum'        => ($price - $discount) * $count,
				];

			}


			$new_factor =
			[
				'type'           => $value['type'],
				'customer'       => $value['new_customer_id'],
				'seller'         => $value['new_seller_id'],
				'date'           => $value['date'],
				'title'          => $value['title'],

				'status'         => $value['status'],
				'vat'            => $value['vat'],
				'discount'       => $value['discount'],
				'discount2'      => $value['discount2'],
				'pre'            => $value['pre'],
				'pay'            => $value['pay'],

				'datecreated'    => $value['datecreated'],
				'datemodified'   => $value['datemodified'],
				'desc'           => $value['desc'],

				'qty'            => $qty,
				'item'           => count($factor_detail),
				'detailsum'      => $detailsum,
				'detaildiscount' => $detaildiscount,
				'detailtotalsum' => $detailtotalsum,
				'sum'            => $detailtotalsum - \lib\price::up($value['discount']),

			];

			$factor_new_id = null;

			$set = \dash\db\config::make_set($new_factor, ['type' => 'insert']);

			$query = " INSERT INTO factors SET $set ";

			$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if($inserr_new_store)
			{
				$factor_new_id = \dash\db::insert_id();
			}

			if(!$factor_new_id)
			{
				\content_transfer\say::end('Can not add factor! '.  json_encode($new_factor, JSON_UNESCAPED_UNICODE));
			}


			foreach ($insert_new_factor_detail as $k => $v)
			{
				$insert_new_factor_detail[$k]['factor_id'] = $factor_new_id;
			}

			$multi_insert_factor_detail = \dash\db\config::make_multi_insert($insert_new_factor_detail);
			if($multi_insert_factor_detail)
			{
				$query = " INSERT INTO factordetails $multi_insert_factor_detail ";
				\dash\db::query($query, 'local' , ['database' => 'jibres_'. $value['new_store_id']]);
			}

			$query = "UPDATE factors SET factors.new_id = $factor_new_id WHERE factors.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);

			if($i === 500)
			{
				\content_transfer\say::info(number_format(self::$count_all) .' Factor transfered ...');
				$i = 0;
			}
		}
	}
}
?>