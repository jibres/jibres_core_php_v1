<?php
namespace lib\db\tax_docdetail;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM tax_docdetail WHERE tax_docdetail.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;

	}


	public static function by_doc_id($_id)
	{
		$query  = "DELETE FROM tax_docdetail WHERE tax_docdetail.tax_document_id = $_id ";
		$result = \dash\db::query($query);
		return $result;

	}

}
?>
