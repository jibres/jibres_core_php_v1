<?php
namespace lib\db\form;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE form SET $set WHERE form.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

}
?>
