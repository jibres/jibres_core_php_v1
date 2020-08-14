<?php
namespace lib\db\tax_docdetail;


class get
{

	public static function by_id($_id)
	{
		$query = "SELECT tax_docdetail.*, (SELECT tax_coding.title FROM tax_coding WHERE tax_coding.id = tax_docdetail.details_id LIMIT 1) AS `details_title` FROM tax_docdetail WHERE tax_docdetail.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_doc_id($_id)
	{
		$query =
		"
			SELECT
				tax_docdetail.*,
				assistant.title AS `assistant_title`,
				assistant.code AS `assistant_code`,
				details.title AS `details_title`,
				details.code AS `details_code`
			FROM
				tax_docdetail
			LEFT JOIN tax_coding AS `assistant` ON assistant.id = tax_docdetail.assistant_id
			LEFT JOIN tax_coding AS `details` ON details.id = tax_docdetail.details_id
			WHERE
				tax_docdetail.tax_document_id = $_id
			ORDER BY tax_docdetail.sort ASC
		";
		$result = \dash\db::get($query);

		return $result;
	}



}
?>
