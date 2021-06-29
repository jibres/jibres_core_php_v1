<?php
namespace lib\db\sitebuilder;


class get
{
	public static function check_duplicate_mode($_page_id, $_mode)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = :page_id AND pagebuilder.mode = :mode LIMIT 1";

		$param  =
		[
			':page_id' => $_page_id,
			':mode'    => $_mode,
		];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}
}
?>