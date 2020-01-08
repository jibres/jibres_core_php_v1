<?php
namespace lib\db\productprices;

class get
{
	public static function last_active($_product_id)
	{
		// $query  = "SELECT * FROM productprices WHERE `product_id` = $_product_id AND `last` = 'yes' AND `enddate` IS NULL ORDER BY `id` DESC LIMIT 1";
		$query  = "SELECT * FROM productprices WHERE `product_id` = $_product_id ORDER BY `id` DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function for_chart($_product_id)
	{
		$query  = "SELECT * FROM productprices WHERE `product_id` = $_product_id ORDER BY `datecreated` ASC";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>