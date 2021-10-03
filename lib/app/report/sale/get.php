<?php
namespace lib\app\report\sale;


class get
{
	public static function master_report($_args = [])
	{

		$raw_result = \lib\db\factors\report::sale_report();


		$result        = [];
		$result['raw'] = $raw_result;

		return $result;
	}
}
?>