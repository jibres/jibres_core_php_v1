<?php
namespace lib\db\tax_document;


class update
{
	public static function reset_number($_data)
	{
		$query = [];
		$new_number = 0;
		foreach ($_data as $key => $value)
		{
			$new_number++;
			$query[] = "UPDATE tax_document SET tax_document.number = $new_number WHERE tax_document.id = $value[id] LIMIT 1 ";
		}

		$query = implode(";", $query);

		$result = \dash\db::query($query, null, ['multi_query' => true]);
		return $result;
	}


	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE tax_document SET $set WHERE tax_document.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}


	public static function balance($_id)
	{
		$query = "SELECT (SUM(tax_docdetail.debtor) - SUM(tax_docdetail.creditor)) AS `balance` FROM tax_docdetail WHERE tax_docdetail.tax_document_id = $_id ";

		$result = \dash\db::get($query, 'balance', true);

		if($result === '0.0000')
		{
			$query  = "UPDATE tax_document SET tax_document.status = 'temp' WHERE tax_document.id = $_id LIMIT 1";
		}
		else
		{
			$query  = "UPDATE tax_document SET tax_document.status = 'draft' WHERE tax_document.id = $_id LIMIT 1";
		}

		$result = \dash\db::query($query);
		return $result;
	}

}
?>
