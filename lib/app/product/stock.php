<?php
namespace lib\app\product;

class stock
{
	public static function calc($_product_id)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return false;
		}

		$load = \lib\db\productstock\get::by_product_id($_product_id);

		$sold    = floatval(\lib\db\factordetails\get::product_sold($_product_id));
		$bought  = floatval(\lib\db\factordetails\get::product_bougth($_product_id));
		$initial = isset($load['initial']) ? floatval($load['initial']) : 0;
		$stock   = ($bought + $initial) - $sold;


		$update =
		[
			'sold'         => $sold,
			'stock'        => $stock,
			'bought'       => $bought,
			'datemodified' => date("Y-m-d H:i:s"),
		];


		if(isset($load['product_id']))
		{
			\lib\db\productstock\update::by_product_id($update, $_product_id);
		}
		else
		{
			$insert = $update;
			$insert['product_id'] = $_product_id;
			\lib\db\productstock\insert::new_record($insert);
		}

	}


	public static function add($_product_id, $_args)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$_args['product_id']   = $_product_id;
		\lib\db\productstock\insert::new_record($_args);
	}


	public static function edit($_product_id, $_args)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$_args['product_id']   = $_product_id;
		\lib\db\productstock\update::by_product_id($_args, $_product_id);
	}


	public static function get($_product_id)
	{
		$load = \lib\db\productstock\get::by_product_id($_product_id);
		return $load;
	}
}
?>