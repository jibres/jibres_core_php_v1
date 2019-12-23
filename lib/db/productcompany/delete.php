<?php
namespace lib\db\productcompany;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM productcompany WHERE productcompany.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
