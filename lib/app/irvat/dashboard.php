<?php
namespace lib\app\irvat;


class dashboard
{
	public static function summary()
	{
		$result = [];

		$result['total_factor'] = floatval(\lib\db\irvat\get::total_factor());

		return $result;
	}
}
?>
