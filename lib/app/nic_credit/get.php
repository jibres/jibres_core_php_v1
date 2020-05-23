<?php
namespace lib\app\nic_credit;


class get
{
	public static function fetch()
	{
		$result = \lib\nic\exec\contact_credit::credit();

		$must_insert = [];
		if(!is_array($result))
		{
			$result = [];
		}

		foreach ($result as $key => $value)
		{
			if(isset($value['roid']) && isset($value['date']))
			{
				$check_duplicate = \lib\db\nic_credit\get::check_duplicate($value['date'], $value['roid']);

				if(!$check_duplicate)
				{
					$value['datecreated'] = date("Y-m-d H:i:s");
					$must_insert[] = $value;
				}
			}
		}

		if(!empty($must_insert))
		{
			\lib\db\nic_credit\insert::multi_insert($must_insert);
		}


		$last = self::last();
		if(isset($last['balance']) && is_numeric($last['balance']))
		{
			// nic credit have less than 50 unit
			if(floatval($last['balance']) < 50)
			{
				\dash\log::set('domain_creditLow', ['my_balance' => $last['balance']]);
			}
		}

		return $result;
	}


	public static function last()
	{
		$last = \lib\db\nic_credit\get::last();
		$last = \lib\app\nic_credit\ready::row($last);
		return $last;
	}
}
?>