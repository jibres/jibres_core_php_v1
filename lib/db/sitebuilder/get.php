<?php
namespace lib\db\sitebuilder;


class get
{

	public static function count_section_in_page($_page_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM pagebuilder WHERE pagebuilder.related_id = :page_id ";

		$param  =
		[
			':page_id' => $_page_id,
		];

		$result = \dash\pdo::get($query, $param, 'count', true);

		return $result;
	}

	public static function check_duplicate_folder($_page_id, $_folder)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = :page_id AND pagebuilder.folder = :folder LIMIT 1";

		$param  =
		[
			':page_id' => $_page_id,
			':folder'    => $_folder,
		];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}


	public static function preview_deleted($_page_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = :page_id AND pagebuilder.status_preview = 'deleted' ";

		$param  =
		[
			':page_id' => $_page_id,
		];

		$result = \dash\pdo::get($query, $param);

		return $result;

	}


	public static function all_section($_page_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = :page_id ";

		$param  =
		[
			':page_id' => $_page_id,
		];

		$result = \dash\pdo::get($query, $param);

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
				pagebuilder.related_id = $_id
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