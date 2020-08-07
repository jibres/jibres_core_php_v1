<?php
namespace lib\db\tax_docdetail;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_doc_id($_id)
	{
		$query = "SELECT * FROM tax_docdetail WHERE tax_docdetail.tax_document_id = $_id ";
		$result = \dash\db::get($query);
		return $result;
	}



}
?>
