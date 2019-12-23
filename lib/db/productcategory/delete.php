<?php
namespace lib\db\productcategory;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM productcategory WHERE productcategory.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
