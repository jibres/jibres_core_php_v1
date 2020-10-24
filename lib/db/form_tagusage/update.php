<?php
namespace lib\db\form_tagusage;


class update
{

	public static function tag_usage_tag_id($_old_id, $_new_id)
	{
		$query  =
		"
			DELETE FROM
				form_tagusage
			WHERE
				form_tagusage.form_tag_id = $_old_id AND
				form_tagusage.answer_id IN
				(
					SELECT x.answer_id FROM
					(
						SELECT
							form_tagusage.answer_id
						FROM
							form_tagusage
						WHERE
							form_tagusage.form_tag_id = $_old_id OR form_tagusage.form_tag_id = $_new_id
						GROUP BY form_tagusage.answer_id
						HAVING COUNT(*) >= 2
					)
					AS `x`
				)
		";
		$remove_duplicate = \dash\db::query($query);


		$query  =
		"
			UPDATE
				form_tagusage
			SET
				form_tagusage.form_tag_id = $_new_id
			WHERE
				form_tagusage.form_tag_id = $_old_id

		";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
