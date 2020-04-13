<?php
namespace lib\db\nic_domainbilling;


class get
{
	public static function my_total_payed($_user_id, $_date = null)
	{
		$date = null;
		if($_date)
		{
			$date = " AND DATE(domainbilling.date) > DATE('$_date') ";
		}

		$query  = "SELECT SUM(domainbilling.price) AS `price` FROM domainbilling WHERE domainbilling.user_id = $_user_id $date";

		$result = \dash\db::get($query, 'price', true, 'nic');

		return $result;
	}
}
?>
