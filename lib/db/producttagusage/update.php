<?php
namespace lib\db\producttagusage;


class update
{



	public static function tag_usage_tag_id($_old_id, $_new_id)
	{
		$query  = "UPDATE producttagusage SET producttagusage.producttag_id = $_new_id WHERE producttagusage.producttag_id = $_old_id ";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>
