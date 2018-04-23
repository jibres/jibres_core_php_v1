<?php
namespace lib\app\report;


class daily
{
	public static function last_30_days($_days = 30, $_sort = 'date', $_order = 'desc')
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			return false;
		}

		if(!in_array($_sort, ['date', 'sum']))
		{
			$_sort = 'date';
		}

		if(!in_array($_order, ['asc', 'desc']))
		{
			$_order = 'desc';
		}

		$result = \lib\db\report\daily::last_30_days($store_id, 'sell', $_days, $_sort, $_order);


		$return = [];

		$return['table'] = $result;

		$result = \lib\app\report::tdate_key($result, 'Y/m/d - D', true);
		$result = \lib\app\report::key_value($result, true);

		$return['chart'] = $result;

		return $return;
	}
}
?>