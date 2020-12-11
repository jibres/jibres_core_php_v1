<?php
namespace dash\db\termusages;


class update
{
	public static function category_usage_cat_id($_old_id, $_new_id)
	{
		$query  =
		"
			DELETE FROM
				termusages
			WHERE
				termusages.term_id = $_old_id AND
				termusages.post_id IN
				(
					SELECT x.post_id FROM
					(
						SELECT
							termusages.post_id
						FROM
							termusages
						WHERE
							termusages.term_id = $_old_id OR termusages.term_id = $_new_id
						GROUP BY termusages.post_id
						HAVING COUNT(*) >= 2
					)
					AS `x`
				)
		";
		$remove_duplicate = \dash\db::query($query);


		$query  =
		"
			UPDATE
				termusages
			SET
				termusages.term_id = $_new_id
			WHERE
				termusages.term_id = $_old_id

		";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>
