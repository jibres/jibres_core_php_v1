<?php
namespace lib\app\report;


class daily
{
	public static function last_30_days()
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			return false;
		}

		$result = \lib\db\report\daily::last_30_days($store_id, 'sell');
		$result = array_reverse($result);
		$result = \lib\app\report::tdate_key($result, 'Y/m/d - D', true);
		$result = \lib\app\report::key_value($result, true);

		return $result;
	}
}
?>