<?php
namespace lib\db\productcomment;


class delete
{

	public static function delete($_id)
	{
		$query  = "DELETE FROM productcomment WHERE productcomment.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>
