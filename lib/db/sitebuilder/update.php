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
			$query[] = "UPDATE pagebuilder SET pagebuilder.sort = :sort WHERE pagebuilder.id = :id LIMIT 1 ";
			$param[] = [':sort' => $sort, ':id' => $id];
		}

		$result = \dash\pdo::multi_query($query, $param);

		return $result;
	}


	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('pagebuilder', $_args, $_id);
	}
}
?>