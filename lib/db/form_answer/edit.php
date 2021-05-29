<?php
namespace lib\db\form_answer;


class edit
{

	public static function makr_all_as_review($_form_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE form_answer SET form_answer.review = '$date' WHERE form_answer.form_id = $_form_id AND form_answer.review IS NULL";
		$result = \dash\db::query($query);

		return $result;
	}

	public static function makr_as_review($_form_id, $_answer_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE form_answer SET form_answer.review = '$date' WHERE form_answer.form_id = $_form_id AND form_answer.id = $_answer_id AND form_answer.review IS NULL";
		$result = \dash\db::query($query);

		return $result;
	}
}
?>