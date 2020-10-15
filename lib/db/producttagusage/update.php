<?php
namespace lib\db\producttagusage;


class update
{

	public static function tag_usage_tag_id($_old_id, $_new_id)
	{
		$query  =
		"
			DELETE FROM
				producttagusage
			WHERE
				producttagusage.producttag_id = $_old_id AND
				producttagusage.product_id IN
				(
					SELECT x.product_id FROM
					(
						SELECT
							producttagusage.product_id
						FROM
							producttagusage
						WHERE
							producttagusage.producttag_id = $_old_id OR producttagusage.producttag_id = $_new_id
						GROUP BY producttagusage.product_id
						HAVING COUNT(*) >= 2
					)
					AS `x`
				)
		";
		$remove_duplicate = \dash\db::query($query);


		$query  =
		"
			UPDATE
				producttagusage
			SET
				producttagusage.producttag_id = $_new_id
			WHERE
				producttagusage.producttag_id = $_old_id

		";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
