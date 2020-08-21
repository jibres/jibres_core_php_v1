<?php
namespace lib\db\form_answerdetail;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE form_answerdetail SET $set WHERE form_answerdetail.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

}
?>
