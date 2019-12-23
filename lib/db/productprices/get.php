<?php
namespace lib\db\productprices;

class get
{
	public static function last_active($_product_id)
	{
		$query  = "SELECT * FROM productprices WHERE `product_id` = $_product_id AND `last` = 'yes' AND `enddate` IS NULL ORDER BY `id` DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>