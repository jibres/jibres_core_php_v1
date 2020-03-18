<?php
namespace lib\app\product;

class find
{

	public static function barcode($_barcode)
	{
		// find in barcode
		$_barcode = \dash\validate::barcode($_barcode, false);
		if(!$_barcode)
		{
			return [];
		}

		$result   = \lib\db\products\get::by_barcode($_barcode);
		if($result)
		{
			$result = \lib\app\product\ready::row($result);
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

				$result = \lib\db\products\get::scalecode(intval($code));
				if($result)
				{
					$result = \lib\app\product\ready::row($result);
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