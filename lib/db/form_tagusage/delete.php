<?php
namespace lib\db\form_tagusage;


class delete
{
	public static function tag_usage_tag_id($_id)
	{
		$query  = "DELETE FROM form_tagusage WHERE form_tagusage.producttag_id = $_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM form_tagusage WHERE $where ";
			return \dash\db::query($query);
		}
	}

	public static function hard_delete_product_tag($_product_tag_ids, $_product_id)
	{
		$query = "DELETE FROM form_tagusage WHERE form_tagusage.producttag_id IN ($_product_tag_ids) AND form_tagusage.product_id = $_product_id ";
		return \dash\db::query($query);
	}



	public static function hard_delete_all_product_tag($_product_id)
	{
		$query = "DELETE FROM form_tagusage WHERE form_tagusage.product_id = $_product_id ";
		return \dash\db::query($query);
	}

}
?>
