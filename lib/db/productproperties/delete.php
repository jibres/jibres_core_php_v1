<?php
namespace lib\db\productproperties;


class delete
{

	public static function multi($_ids)
	{
		$query = "DELETE FROM productproperties WHERE productproperties.id IN ($_ids) ";
		return \dash\db::query($query);
	}
}
?>
