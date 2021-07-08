<?php
namespace lib\db\sitebuilder;


class get
{
	public static function check_duplicate_mode($_page_id, $_mode)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = :page_id AND pagebuilder.mode = :mode LIMIT 1";

		$param  =
		[
			':page_id' => $_page_id,
			':mode'    => $_mode,
		];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}




	public static function line_list_preview(int $_id)
	{
		$query  =
		"
			SELECT
				*
			FROM
				pagebuilder
			WHERE
				pagebuilder.related_id = $_id AND
				(pagebuilder.status_preview IS NULL OR pagebuilder.status_preview != 'deleted')
			ORDER BY
				FIELD(pagebuilder.mode, 'header', 'body', 'footer'),
				pagebuilder.sort_preview ASC,
				pagebuilder.id ASC
			LIMIT 1000
		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>