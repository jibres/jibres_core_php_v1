<?php
namespace lib\db\producttagusage;


class delete
{


	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM producttagusage WHERE $where ";
			return \dash\db::query($query);
		}
	}


	public static function hard_delete_all_product_tag($_product_id)
	{
		$query = "DELETE FROM producttagusage WHERE producttagusage.product_id = $_product_id ";
		return \dash\db::query($query);
	}

}
?>
