<?php
namespace content_transfer\_factor;

class transfer
{


	public static function run()
	{

		$query =
		"

			SELECT
				factors.*
			FROM
				factors
			INNER JOIN userstores ON factors.seller = userstores.id
			WHERE
				userstores.store_id != factors.store_id
		";

		$check = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);
		if($check)
		{
			if(isset($check[0]['id']) && count($check) === 1 && intval($check[0]['id']) === 1000408)
			{
				$Fquery = "UPDATE factors SET factors.seller = 11 WHERE factors.id = 1000408 LIMIT 1";
				$check = \dash\db::query($Fquery, 'local', ['database' => 'jibres_transfer']);
			}
			else
			{
				\content_transfer\say::error('We have some factors can not be transfered. fix it ...');
				\content_transfer\say::end(json_encode($check, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		}

		$query = [];
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_price` bigint(20) unsigned NULL DEFAULT NULL AFTER `price`;";
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_count` int(10) unsigned NULL DEFAULT NULL AFTER `count`;";
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_discount` bigint(20) unsigned NULL DEFAULT NULL AFTER `discount`;";
		$query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_sum` bigint(20) unsigned NULL DEFAULT NULL AFTER `sum`;";
		// $query[] = "ALTER TABLE jibres_transfer.factordetails ADD `new_vat` int(10) unsigned NULL DEFAULT NULL AFTER `vat`;";

		$query[] = "UPDATE jibres_transfer.factordetails SET jibres_transfer.factordetails.new_price = jibres_transfer.factordetails.price * 100 ;";
		$query[] = "UPDATE jibres_transfer.factordetails SET jibres_transfer.factordetails.new_count = jibres_transfer.factordetails.count * 1000 ;";
		$query[] = "UPDATE jibres_transfer.factordetails SET jibres_transfer.factordetails.new_discount = jibres_transfer.factordetails.discount * 100 ;";

		$query[] = "UPDATE jibres_transfer.factordetails SET jibres_transfer.factordetails.new_sum = (jibres_transfer.factordetails.new_price - jibres_transfer.factordetails.new_discount) * jibres_transfer.factordetails.new_count ;";


		$query[] = "ALTER TABLE jibres_transfer.factors ADD  `new_qty` int(10) UNSIGNED DEFAULT NULL AFTER `qty`;";
		$query[] = "ALTER TABLE jibres_transfer.factors ADD  `new_item` bigint(20) UNSIGNED DEFAULT NULL AFTER `item`;";
		$query[] = "ALTER TABLE jibres_transfer.factors ADD  `new_detailsum` bigint(20) UNSIGNED DEFAULT NULL AFTER `detailsum`;";
		$query[] = "ALTER TABLE jibres_transfer.factors ADD  `new_detaildiscount` bigint(20) DEFAULT NULL AFTER `detaildiscount`;";
		$query[] = "ALTER TABLE jibres_transfer.factors ADD  `new_detailtotalsum` bigint(20) UNSIGNED DEFAULT NULL AFTER `detailtotalsum`;";
		$query[] = "ALTER TABLE jibres_transfer.factors ADD  `new_discount` int(10) DEFAULT NULL AFTER `discount`;";
		$query[] = "ALTER TABLE jibres_transfer.factors ADD  `new_sum` bigint(20) UNSIGNED DEFAULT NULL AFTER `sum`;";

		$query[] = "UPDATE jibres_transfer.factors SET jibres_transfer.factors.new_detailsum = (SELECT SUM(jibres_transfer.factordetails.new_price * jibres_transfer.factordetails.new_count) FROM jibres_transfer.factordetails WHERE jibres_transfer.factordetails.factor_id = jibres_transfer.factors.id ) ;";
		$query[] = "UPDATE jibres_transfer.factors SET jibres_transfer.factors.new_detaildiscount = (SELECT SUM(jibres_transfer.factordetails.new_discount * jibres_transfer.factordetails.new_count) FROM jibres_transfer.factordetails WHERE jibres_transfer.factordetails.factor_id = jibres_transfer.factors.id ) ;";
		$query[] = "UPDATE jibres_transfer.factors SET jibres_transfer.factors.new_qty = (SELECT SUM(jibres_transfer.factordetails.new_count) FROM jibres_transfer.factordetails WHERE jibres_transfer.factordetails.factor_id = jibres_transfer.factors.id ) ;";

		$query[] = "UPDATE jibres_transfer.factors SET jibres_transfer.factors.new_detailtotalsum = (SELECT SUM((jibres_transfer.factordetails.new_price * jibres_transfer.factordetails.new_count) - (jibres_transfer.factordetails.new_discount * jibres_transfer.factordetails.new_count)) FROM jibres_transfer.factordetails WHERE jibres_transfer.factordetails.factor_id = jibres_transfer.factors.id ) ;";

		$query[] = "UPDATE jibres_transfer.factors SET jibres_transfer.factors.new_sum = jibres_transfer.factors.new_detailtotalsum ;";

		\dash\file::delete(__DIR__. '/run.me.sql');

		foreach ($query as $key => $value)
		{
			\dash\file::append(__DIR__. '/run.me.sql', $value. "\n");
		}

		\content_transfer\say::info('Transfer factors ...');
		self::factor();

		\content_transfer\say::info('RUN THIS CODE: mysql -uroot -p < '. __DIR__. '/run.me.sql');

	}


	private static function factor()
	{
		$query = "SELECT * FROM stores";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);
		foreach ($result as $key => $value)
		{
			$customer_db = 'jibres_'. $value['new_id'];

			$INSERT_FACTORS =
			"
				INSERT INTO $customer_db.factors
				(
					$customer_db.factors.id,
					$customer_db.factors.type,
					$customer_db.factors.customer,
					$customer_db.factors.seller,
					$customer_db.factors.date,
					$customer_db.factors.title,
					$customer_db.factors.qty,
					$customer_db.factors.item,
					$customer_db.factors.detailsum,
					$customer_db.factors.detaildiscount,
					$customer_db.factors.detailtotalsum,
					$customer_db.factors.vat,
					$customer_db.factors.discount,
					$customer_db.factors.discount2,
					$customer_db.factors.pre,
					$customer_db.factors.transport,
					$customer_db.factors.sum,
					$customer_db.factors.pay,
					$customer_db.factors.address_id,
					$customer_db.factors.status,
					$customer_db.factors.datecreated,
					$customer_db.factors.datemodified,
					$customer_db.factors.desc
				)
				SELECT
					jibres_transfer.factors.id,
					jibres_transfer.factors.type,
					IF(
					jibres_transfer.factors.customer IS NOT NULL ,
					(
						SELECT jibres_transfer.userstores.new_id
						FROM jibres_transfer.userstores
						WHERE jibres_transfer.userstores.id = jibres_transfer.factors.customer
						AND jibres_transfer.userstores.store_id = jibres_transfer.factors.store_id
						LIMIT 1 ),
					 NULL
				  	),
					(
						SELECT jibres_transfer.userstores.new_id
						FROM jibres_transfer.userstores
						WHERE jibres_transfer.userstores.id = jibres_transfer.factors.seller
						AND jibres_transfer.userstores.store_id = jibres_transfer.factors.store_id
						LIMIT 1
					),
					jibres_transfer.factors.date,
					jibres_transfer.factors.title,
					jibres_transfer.factors.new_qty,
					jibres_transfer.factors.item,
					jibres_transfer.factors.new_detailsum,
					jibres_transfer.factors.new_detaildiscount,
					jibres_transfer.factors.new_detailtotalsum,
					jibres_transfer.factors.vat,
					jibres_transfer.factors.discount,
					jibres_transfer.factors.discount2,
					jibres_transfer.factors.pre,
					jibres_transfer.factors.transport,
					jibres_transfer.factors.new_sum,
					jibres_transfer.factors.pay,
					NULL,
					jibres_transfer.factors.status,
					jibres_transfer.factors.datecreated,
					jibres_transfer.factors.datemodified,
					jibres_transfer.factors.desc
				FROM
					jibres_transfer.factors
				WHERE jibres_transfer.factors.store_id = $value[id];
			";


			$INSERT_FACTORS_DETAILS =
			"
				INSERT INTO $customer_db.factordetails
				(
					$customer_db.factordetails.factor_id,
					$customer_db.factordetails.product_id,
					$customer_db.factordetails.price,
					$customer_db.factordetails.count,
					$customer_db.factordetails.discount,
					$customer_db.factordetails.sum,
					$customer_db.factordetails.vat

				)
				SELECT
					jibres_transfer.factordetails.factor_id,
					(SELECT jibres_transfer.products.new_id FROM jibres_transfer.products WHERE jibres_transfer.products.id = jibres_transfer.factordetails.product_id),
					jibres_transfer.factordetails.new_price,
					jibres_transfer.factordetails.new_count,
					jibres_transfer.factordetails.new_discount,
					jibres_transfer.factordetails.new_sum,
					NULL
				FROM
					jibres_transfer.factordetails
				INNER JOIN jibres_transfer.factors ON jibres_transfer.factors.id = jibres_transfer.factordetails.factor_id
				WHERE jibres_transfer.factors.store_id = $value[id];
			";


			\dash\file::append(__DIR__. '/run.me.sql', $INSERT_FACTORS);
			\dash\file::append(__DIR__. '/run.me.sql', $INSERT_FACTORS_DETAILS);
		}

	}

}
?>