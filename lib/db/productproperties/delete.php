<?php
namespace lib\db\productproperties;


class delete
{

	public static function multi($_ids)
	{
		$query = "DELETE FROM productproperties WHERE productproperties.id IN ($_ids) ";
		return \dash\db::query($query);
	}


	public static function one($_id, $_product_id)
	{
		$query = "DELETE FROM productproperties WHERE productproperties.id = $_id AND productproperties.product_id = $_product_id LIMIT 1 ";
		return \dash\db::query($query);
	}
}
?>
