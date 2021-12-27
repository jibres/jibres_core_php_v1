<?php
namespace lib\db\tax_docdetail;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('tax_docdetail', $_args, $_id);
	}

	public static function set_sort($_sort)
	{
		$query = [];
		foreach ($_sort as $sort => $id)
		{
			$query[] = "UPDATE tax_docdetail SET tax_docdetail.sort = $sort WHERE tax_docdetail.id = $id LIMIT 1 ";
		}

		$result = \dash\pdo::query(implode(';', $query), [], null, ['multi_query' => true]);
		return $result;
	}

}
?>
