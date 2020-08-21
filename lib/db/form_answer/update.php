<?php
namespace lib\db\form_answer;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE form_answer SET $set WHERE form_answer.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

}
?>
