<?php
namespace lib\db\sitebuilder;


class delete
{
	public static function page($_id)
	{
		$query  = "DELETE FROM pagebuilder WHERE pagebuilder.related_id = :id ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::query($query, $param);

		$query  = "DELETE FROM posts WHERE posts.id = :id LIMIT 1";
		$param  = [':id' => $_id];
		$result = \dash\pdo::query($query, $param);

		return $result;
	}
}
?>