<?php
namespace lib\db\tax_document;


class update
{


	public static function gallery($_gallery, $_id)
	{
		$query  = "UPDATE tax_document SET tax_document.gallery = '$_gallery' WHERE tax_document.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

	public static function gallery_set_null($_id)
	{
		$query  = "UPDATE tax_document SET tax_document.gallery = NULL WHERE tax_document.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

	public static function whole_reset_number($_year_id)
	{
		\dash\pdo::query("SET @cnt = 0;", []);
		$query =
		"
			UPDATE
				tax_document
			SET
				tax_document.number = @cnt := @cnt + 1
			WHERE
				tax_document.status = 'lock' AND
				tax_document.year_id = $_year_id
			ORDER BY
				FIELD(tax_document.type, 'opening', 'normal', 'closing'),
				tax_document.date ASC,
				tax_document.subnumber IS NOT NULL,
				tax_document.subnumber ASC,
				tax_document.id ASC
		";

		return \dash\pdo::query($query, []);

	}

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

		$result = \dash\pdo::query($query, [], null, ['multi_query' => true]);
		return $result;
	}


	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('tax_document', $_args, $_id);

	}


	public static function balance($_id)
	{
		$query = "SELECT (SUM(tax_docdetail.debtor) - SUM(tax_docdetail.creditor)) AS `balance` FROM tax_docdetail WHERE tax_docdetail.tax_document_id = $_id ";

		$result = \dash\pdo::get($query, [], 'balance', true);

		if($result === '0.0000')
		{
			$query  = "UPDATE tax_document SET tax_document.status = 'temp' WHERE tax_document.id = $_id LIMIT 1";
		}
		else
		{
			$query  = "UPDATE tax_document SET tax_document.status = 'draft' WHERE tax_document.id = $_id LIMIT 1";
		}

		$result = \dash\pdo::query($query, []);
		return $result;
	}

}
?>
