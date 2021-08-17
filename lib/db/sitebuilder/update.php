<?php
namespace lib\db\sitebuilder;


class update
{
	public static function set_sort($_sort)
	{
		$query = [];
		$param = [];

		foreach ($_sort as $sort => $id)
		{
			$query[] = "UPDATE pagebuilder SET pagebuilder.sort_preview = :sort WHERE pagebuilder.id = :id LIMIT 1 ";
			$param[] = [':sort' => $sort, ':id' => $id];
		}

		$result = \dash\pdo::multi_query($query, $param);

		return $result;
	}


	public static function save_page($_page_id)
	{
		$param  = [':page_id' => $_page_id];

		\dash\pdo::transaction();

		$query  = "SELECT * FROM  pagebuilder WHERE pagebuilder.related_id = :page_id FOR UPDATE";
		$result = \dash\pdo::query($query, $param);

		$query  =
		"
			UPDATE
				pagebuilder
			SET
				pagebuilder.body   = pagebuilder.preview,
				pagebuilder.sort   = pagebuilder.sort_preview,
				pagebuilder.status = pagebuilder.status_preview,
				pagebuilder.text   = pagebuilder.text_preview
			WHERE
				pagebuilder.related_id = :page_id
		";

		$result = \dash\pdo::query($query, $param);

		$query  =
		"
			UPDATE
				pagebuilder
			SET
				pagebuilder.status = 'enable'
			WHERE
				pagebuilder.related_id = :page_id AND
				pagebuilder.status       = 'draft'
		";
		$result = \dash\pdo::query($query, $param);


		$query  =
		"
			UPDATE
				pagebuilder
			SET
				pagebuilder.status_preview = 'enable'
			WHERE
				pagebuilder.related_id   = :page_id AND
				pagebuilder.status_preview = 'draft'
		";

		$result = \dash\pdo::query($query, $param);

		\dash\pdo::commit();

		$query  = "DELETE FROM pagebuilder WHERE pagebuilder.related_id = :page_id AND pagebuilder.status_preview = 'deleted' ";
		$result = \dash\pdo::query($query, $param);

		$query  = "UPDATE posts SET posts.status = 'publish' WHERE posts.id = :page_id LIMIT 1";
		$result = \dash\pdo::query($query, $param);

		return $result;
	}


	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('pagebuilder', $_args, $_id);
	}
}
?>