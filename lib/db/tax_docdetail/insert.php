<?php
namespace lib\db\tax_docdetail;


class insert
{

	public static function duplicate($_old_id, $_new_id)
	{
		$date = date("Y-m-d H:i:s");
		$query =
		"
			INSERT INTO tax_docdetail
			(
				`tax_document_id`,
				`assistant_id`,
				`details_id`,
				`desc`,
				`debtor`,
				`creditor`,
				`datecreated`,
				`datemodified`,
				`year_id`,
				`sort`
			)
			SELECT
				$_new_id,
				tax_docdetail.assistant_id,
				tax_docdetail.details_id,
				tax_docdetail.desc,
				tax_docdetail.debtor,
				tax_docdetail.creditor,
				'$date',
				null,
				tax_docdetail.year_id,
				tax_docdetail.sort
			FROM tax_docdetail WHERE tax_docdetail.tax_document_id = $_old_id
		";

		$result = \dash\pdo::query($query, []);
		return $result;
	}

	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('tax_docdetail', $_args);
	}

}
?>
