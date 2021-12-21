<?php
namespace lib\db\discount;


class insert
{

	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `discount` SET $set ";
			if(\dash\pdo::query($query, []))
			{
				return \dash\pdo::insert_id();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function duplicate($_old_id, $_new_code)
	{
		$now = date("Y-m-d H:i:s");

		$query =
		"
			INSERT INTO discount
			(
				`id`,
				`code`,
				`type`,
				`minrequirements`,
				`percentage`,
				`fixedamount`,
				`maxamount`,
				`minpurchase`,
				`minquantity`,
				`startdate`,
				`enddate`,
				`applyto`,
				`freeshipping`,
				`customer`,
				`creator`,
				`usagetotal`,
				`usageperuser`,
				`datecreated`,
				`datemodified`,
				`datefirstuse`,
				`datefinish`,
				`status`,
				`usagestatus`,
				`desc`
			)
			SELECT
				NULL,
				'$_new_code',
				discount.type,
				discount.minrequirements,
				discount.percentage,
				discount.fixedamount,
				discount.maxamount,
				discount.minpurchase,
				discount.minquantity,
				discount.startdate,
				discount.enddate,
				discount.applyto,
				discount.freeshipping,
				discount.customer,
				discount.creator,
				discount.usagetotal,
				discount.usageperuser,
				'$now',
				NULL,
				NULL,
				NULL,
				discount.status,
				NULL,
				discount.desc
			FROM
				discount
			WHERE
				discount.id = $_old_id
			LIMIT 1
		";

		$result = \dash\pdo::query($query, []);

		$new_id = \dash\pdo::insert_id();

		if(!$new_id)
		{
			return false;
		}


		$query =
		"
			INSERT INTO discount_dedicated
			(
				`discount_id`,
				`type`,
				`product_id`,
				`customer_id`,
				`product_category_id`,
				`specailvalue`,
				`datecreated`
			)
			SELECT
				$new_id,
				discount_dedicated.type,
				discount_dedicated.product_id,
				discount_dedicated.customer_id,
				discount_dedicated.product_category_id,
				discount_dedicated.specailvalue,
				'$now'
			FROM
				discount_dedicated
			WHERE
				discount_dedicated.discount_id = $_old_id
		";

		\dash\pdo::query($query, []);

		return $new_id;
	}

}
?>
