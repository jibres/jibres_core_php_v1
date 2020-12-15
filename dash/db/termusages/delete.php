<?php
namespace dash\db\termusages;


class delete
{

	public static function by_post_id($_post_id)
	{
		$query  = "DELETE FROM termusages WHERE termusages.post_id = $_post_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function category_usage_cat_id($_id)
	{
		$query  = "DELETE FROM termusages WHERE termusages.term_id = $_id ";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM termusages WHERE $where ";
			return \dash\db::query($query);
		}
	}


	public static function hard_delete_category($_term_ids, $_post_id)
	{
		$query = "DELETE FROM termusages WHERE termusages.term_id IN ($_term_ids) AND termusages.post_id = $_post_id ";
		return \dash\db::query($query);
	}


	public static function hard_delete_all_cat($_post_id, $_type)
	{
		$query = "DELETE FROM termusages WHERE termusages.post_id = $_post_id AND termusages.type = '$_type' ";
		return \dash\db::query($query);
	}

}
?>
