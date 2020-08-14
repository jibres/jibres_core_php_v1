<?php
namespace lib\db\tax_docdetail;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE tax_docdetail SET $set WHERE tax_docdetail.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

	public static function set_sort($_sort)
	{
		$query = [];
		foreach ($_sort as $sort => $id)
		{
			$query[] = "UPDATE tax_docdetail SET tax_docdetail.sort = $sort WHERE tax_docdetail.id = $id LIMIT 1 ";
		}

		$result = \dash\db::query(implode(';', $query), null, ['multi_query' => true]);
		return $result;
	}

}
?>
