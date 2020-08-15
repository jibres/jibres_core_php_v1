<?php
namespace lib\db\productprices;

class get
{




	public static function count_all()
	{
		$query = "SELECT COUNT(*) AS `count` FROM productprices ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


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


	public static function special_date($_product_id, $_date)
	{
		$query  =
		"
			SELECT * FROM productprices
			WHERE productprices.product_id    = $_product_id
			AND DATE(productprices.startdate) <= DATE('$_date')
			AND (DATE(productprices.enddate)   >= DATE('$_date') || productprices.enddate IS NULL)
			ORDER BY productprices.id DESC
			LIMIT 50
		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>