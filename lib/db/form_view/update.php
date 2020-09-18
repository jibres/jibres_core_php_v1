<?php
namespace lib\db\form_view;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE form_view SET $set WHERE form_view.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

}
?>
