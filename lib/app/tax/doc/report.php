<?php
namespace lib\app\tax\doc;


class report
{

	public static function detail_report()
	{
		$result = \lib\db\tax_document\get::detail_report();
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $result);
		return $result;


	}

}
?>