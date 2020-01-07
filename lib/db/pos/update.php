<?php
namespace lib\db\pos;


class update
{


	public static function set_default($_id)
	{
		$query = "UPDATE pos SET pos.isdefault = NULL  WHERE pos.id != $_id";
		$result = \dash\db::query($query);

		$query = "UPDATE pos SET pos.isdefault = 1  WHERE pos.id = $_id";
		$result = \dash\db::query($query);

		return $result;
	}

}
?>