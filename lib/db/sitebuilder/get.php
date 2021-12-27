<?php
namespace lib\db\sitebuilder;


class get
{

	public static function by_id_lock(int $_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.id = :id LIMIT 1 FOR UPDATE";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function by_id(int $_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.id = :id LIMIT 1 ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function by_id_related_id($_id, $_related_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.id = :id AND pagebuilder.related_id = :related_id LIMIT 1";
		$param  = [':id' => $_id, ':related_id' => $_related_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function sort_id_by_related($_related_id)
	{
		$query  = "SELECT pagebuilder.id, pagebuilder.sort_preview FROM pagebuilder WHERE pagebuilder.related_id = :related_id AND pagebuilder.folder NOT IN ('header', 'footer') ORDER BY pagebuilder.sort ASC, pagebuilder.id ASC";
		$param  = [':related_id' => $_related_id];
		$result = \dash\pdo::get($query, $param);
		return $result;
	}




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


	public static function homepage_header_footer($_related_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = :related_id AND pagebuilder.folder IN ('header', 'footer') ";
		$param  = [':related_id' => $_related_id];
		$result = \dash\pdo::get($query, $param);
		return $result;
	}

	public static function line_list_with_homepage_header_footer($_id, $_related_id)
	{

		$query  =
		"
			SELECT
				*
			FROM
				pagebuilder
			WHERE
				pagebuilder.related_id = :id OR
				(
					pagebuilder.related_id = :related_id AND
					pagebuilder.folder IN ('header', 'footer')
				)

			ORDER BY
				FIELD(pagebuilder.folder, 'header', 'body', 'footer'),
				pagebuilder.sort ASC,
				pagebuilder.id ASC
			LIMIT 1000
		";

		$param  = [':id' => $_id, ':related_id' => $_related_id];
		$result = \dash\pdo::get($query, $param);
		return $result;

	}



	public static function line_list_with_homepage_header_footer_preview($_id, $_related_id)
	{
		$query  =
		"
			SELECT
				*
			FROM
				pagebuilder
			WHERE
				pagebuilder.related_id = :id OR
				(
					pagebuilder.related_id = :related_id AND
					pagebuilder.folder IN ('header', 'footer')
				)

			ORDER BY
				FIELD(pagebuilder.folder, 'header', 'body', 'footer'),
				pagebuilder.sort_preview ASC,
				pagebuilder.id ASC
			LIMIT 1000
		";

		$param  = [':id' => $_id, ':related_id' => $_related_id];
		$result = \dash\pdo::get($query, $param);
		return $result;

	}




	public static function last_sort($_args)
	{
		$q  = \dash\pdo\prepare_query::generate_where('products', $_args);

		$query  = "SELECT pagebuilder.sort AS `sort` FROM pagebuilder WHERE $q[where] ORDER BY pagebuilder.sort DESC, pagebuilder.id DESC LIMIT 1";
		$param  = $q['param'];
		$result = \dash\pdo::get($query, $param, 'sort', true);

		return $result;
	}



	public static function line_list(int $_id)
	{
		$query  =
		"
			SELECT
				*
			FROM
				pagebuilder
			WHERE
				pagebuilder.related_id = :id
			ORDER BY
				FIELD(pagebuilder.folder, 'header', 'body', 'footer'),
				pagebuilder.sort ASC,
				pagebuilder.id ASC
			LIMIT 1000
		";

		$param  = [':id' => $_id];
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
				pagebuilder.related_id = :id
			ORDER BY
				FIELD(pagebuilder.folder, 'header', 'body', 'footer'),
				pagebuilder.sort_preview ASC,
				pagebuilder.id ASC
			LIMIT 1000
		";

		$param  =
		[
			':id' => $_id,
		];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}
}
?>