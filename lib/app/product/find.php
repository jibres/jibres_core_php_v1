<?php
namespace lib\app\product;

class find
{

	public static function barcode($_barcode)
	{
		// find in barcode
		$_barcode = \dash\utility\convert::to_barcode($_barcode);
		$result   = \lib\db\products\get::barcode($_barcode);
		if($result)
		{
			return $result;
		}

		// if barcode is number and
		$barcode = \dash\utility\convert::to_en_number($_barcode);

		if(is_numeric($barcode))
		{
			if(mb_strlen($barcode) === 12 || mb_strlen($barcode) === 13)
			{
				$code     = substr($barcode, 2, 5);
				$quantity = substr($barcode, 7, 5);

				$get_product =
				[
					'store_id'  => \lib\store::id(),
					'scalecode' => intval($code),
					'limit'     => 1,
				];

				$result = \lib\db\products::get($get_product);
				if($result)
				{
					$result['scale']    = true;
					$result['scaleDuplicate'] = T_("This barcode is scanned before");
					$result['quantity'] = intval($quantity) / 1000;
					return $result;
				}
			}
		}

		return [];
	}
}
?>